<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\HomepageSection;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\ProductVariationDetails;
use App\Models\SiteSetting;
use App\Models\State;
use App\Models\City;
use App\Models\Slider;
use App\Models\PromoteAds;
use App\Models\Addvertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Auth;
use Session;
use App\Models\Cart;

class HomeController extends Controller
{
    //home page function
    public function index(Request $request)
    {
        $data = [];
        //get all homepage section
        $data['sections'] = HomepageSection::where('page_name', 'homepage')->where('status', 1)->orderBy('position', 'asc')->paginate(48);

        //check ajax request
        if ($request->ajax()) {
            $view = view('frontend.homepage.homesection', $data)->render();
            return response()->json(['html' => $view]);
        }
        $data['slider'] = Slider::where('status', 1)->where('type', 'homepage')->orderBy('position', 'asc')->first();

        return view('frontend.home')->with($data);
    }

    //product show by category
    public function category(Request $request, string $location = null, string $catslug = '')
    {
        $data['products'] = $data['banners'] = $data['product_variations'] = $data['category'] = $data['filterCategories'] = $data['brands'] = $data['pinAds'] = $data['urgentAds'] = $data['highlightAds'] = $data['fastAds'] = [];

        $ads_duration = SiteSetting::where('type', 'free_ads_limit')->first();
        $ads_duration =  Carbon::parse(now())->subDays($ads_duration->value2);
        $category_id = $state_id = $city_id = 0;
        $keyword = $request->q;

        if (!is_array($request->member)) { // direct url tags
            $member = explode(',', $request->member);
        } else { // filter by ajax
            $member = implode(',', $request->member);
        }

        //check selected category or subcategory
        $data['category'] = Category::where('slug', $catslug)->first();

        if ($data['category']) {
            $category_id = $data['category']->id;
        }
        //check city or state
        $data['state'] = City::where('slug', $location)->orderBy('name', 'asc')->first();

        if ($data['state']) {
            $city_id = $data['state']->id;
        } else {
            $data['state'] = State::where('slug', $location)->orderBy('name', 'asc')->first();
            $state_id = ($data['state']) ? $data['state']->id : null;
        }


        $sortby = ($request->sortby) ? $request->sortby : null;
        $price_min = ($request->price_min) ? $request->price_min : null;
        $price_max = ($request->price_max) ? $request->price_max : null;

        $data['product_variations'] = ProductAttribute::withCount(['get_productVariationDetails', 'get_productVariationDetails as get_product_variation_details_count' => function ($query) {
            $query->where('get_product_variation_details_count', '>', 0);
        }])->with(['get_attrValues' => function ($query) use ($ads_duration, $category_id, $state_id, $city_id) {
            $query->withCount(['get_variantProducts'  => function ($query) use ($ads_duration, $category_id, $state_id, $city_id) {
                $query->leftJoin('products', 'product_variation_details.product_id', 'products.id')->where('approved', '>=', $ads_duration);
                if ($category_id) {
                    $query->where(function ($q) use ($category_id) {
                        $q->orWhere('category_id', $category_id)->orWhere('subcategory_id', $category_id);
                    });
                }
                if ($state_id) {
                    $query->where('state_id', $state_id);
                }
                if ($city_id) {
                    $query->where('city_id', $city_id);
                }
            }]);
        }])->where('category_id', $category_id)->where('is_filter', 1)->get();

        $productsFilter = [];
        //check weather ajax request identify filter parameter
        foreach ($data['product_variations'] as $filterAttr) {
            $filter = strtolower(str_replace(' ', '', $filterAttr->name));

            if ($request->$filter) {

                if (!is_array($request->$filter)) { // direct url tags
                    $tags = explode(',', $request->$filter);
                } else { // filter by ajax
                    $tags = implode(',', $request->$filter);
                }

                //get product id from url filter id (size=1,2)
                $productsFilter = ProductVariationDetails::join('product_attribute_values', 'product_variation_details.attributeValue_name', 'product_attribute_values.id')->whereIn('name', $tags)->groupBy('product_id')->get()->pluck('product_id');
            }
        }

        //get banner promote ads by category
        $bannerAds = PromoteAds::join("users", "users.id", "promote_ads.user_id")->leftJoin("memberships", "memberships.slug", "users.membership")->join("products", "products.id", "promote_ads.ads_id")->join("states", "states.id", "products.state_id")->join("categories", "categories.id", "products.subcategory_id")->join("packages", "packages.id", "promote_ads.package_id")->where('package_id', 5)->where('start_date', '<=', now())->where('end_date', '>=', now());

        if ($category_id) {
            $bannerAds->where(function ($q) use ($category_id) {
                $q->orWhere('products.category_id', $category_id)->orWhere('products.subcategory_id', $category_id);
            });
        }
        if ($request->member) {
            $bannerAds->where('users.membership', $member);
        }
        if ($state_id) {
            $bannerAds->where('state_id', $state_id);
        }
        if ($city_id) {
            $bannerAds->where('city_id', $city_id);
        }

        //check variation
        if (count($productsFilter) > 0) {
            $bannerAds->whereIn('products.id', $productsFilter);
        }
        if ($keyword) {
            $bannerAds->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')->orWhere('categories.name', 'like', '%' . $keyword . '%');
            });
        }
        $field = 'promote_ads.id';
        $value = 'desc';
        if ($sortby) {
            try {
                $sort = explode('-', $sortby);
                if ($sort[0] == 'name') {
                    $field = 'title';
                } elseif ($sort[0] == 'price') {
                    $field = 'price';
                } else {
                    $field = 'promote_ads.id';
                }
                $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                $bannerAds->orderBy($field, $value);
            } catch (\Exception $exception) {
            }
        } else {
            $bannerAds->orderBy($field, $value);
        }

        //check price keyword
        if ($price_min) {
            $bannerAds->where('price', '>=', $price_min);
        }
        if ($price_max) {
            $bannerAds->where('price', '<=', $price_max);
        }
        $data["bannerAds"] = $bannerAds->inRandomOrder()->take(7)->where('products.status', 'active')->where('promote_ads.status', 1)->selectRaw("products.title, products.id,products.slug,products.feature_image,products.price, sale_type, post_type, ads_id, packages.ribbon, states.name as state_name, categories.name as category_name, users.name,users.username, memberships.name as membership_name, memberships.ribbon as membership_ribbon")->get();



        //not get paid ad when select premium ad
        if (!$request->ad) {
            //get pin promote ads by category
            $pinAds = PromoteAds::join("users", "users.id", "promote_ads.user_id")->leftJoin("memberships", "memberships.slug", "users.membership")->join("products", "products.id", "promote_ads.ads_id")->join("states", "states.id", "products.state_id")->join("categories", "categories.id", "products.subcategory_id")->join("packages", "packages.id", "promote_ads.package_id")->where('package_id', 3)->where('start_date', '<=', now())->where('end_date', '>=', now());

            if ($category_id) {
                $pinAds->where(function ($q) use ($category_id) {
                    $q->orWhere('products.category_id', $category_id)->orWhere('products.subcategory_id', $category_id);
                });
            }
            if ($request->member) {
                $pinAds->where('users.membership', $member);
            }
            if ($state_id) {
                $pinAds->where('state_id', $state_id);
            }
            if ($city_id) {
                $pinAds->where('city_id', $city_id);
            }
            //check variation
            if (count($productsFilter) > 0) {
                $pinAds->whereIn('products.id', $productsFilter);
            }
            if ($keyword) {
                $pinAds->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')->orWhere('categories.name', 'like', '%' . $keyword . '%');
                });
            }
            $field = 'promote_ads.id';
            $value = 'desc';
            if ($sortby) {
                try {
                    $sort = explode('-', $sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'price';
                    } else {
                        $field = 'promote_ads.id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $pinAds->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            } else {
                $pinAds->orderBy($field, $value);
            }

            //check price keyword
            if ($price_min) {
                $pinAds->where('price', '>=', $price_min);
            }
            if ($price_max) {
                $pinAds->where('price', '<=', $price_max);
            }
            $data["pinAds"] = $pinAds->inRandomOrder()->where('products.status', 'active')->where('promote_ads.status', 1)->selectRaw("products.title, products.id,products.slug,packages.slug as promote_slug,packages.id as promote_id,products.feature_image,products.price, sale_type, post_type, ads_id, packages.ribbon, states.name as state_name, categories.name as category_name, users.name,users.username, memberships.name as membership_name, memberships.ribbon as membership_ribbon")->get();

            //get promote ads by category
            $urgentAds = PromoteAds::join("users", "users.id", "promote_ads.user_id")->leftJoin("memberships", "memberships.slug", "users.membership")->join("products", "products.id", "promote_ads.ads_id")->join("states", "states.id", "products.state_id")->join("categories", "categories.id", "products.subcategory_id")->join("packages", "packages.id", "promote_ads.package_id")->where('package_id', 4)->where('start_date', '<=', now())->where('end_date', '>=', now());

            if ($category_id) {
                $urgentAds->where(function ($q) use ($category_id) {
                    $q->orWhere('products.category_id', $category_id)->orWhere('products.subcategory_id', $category_id);
                });
            }
            if ($request->member) {
                $urgentAds->where('users.membership', $member);
            }
            if ($state_id) {
                $urgentAds->where('state_id', $state_id);
            }
            if ($city_id) {
                $urgentAds->where('city_id', $city_id);
            }
            //check variation
            if (count($productsFilter) > 0) {
                $urgentAds->whereIn('products.id', $productsFilter);
            }
            if ($keyword) {
                $urgentAds->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')->orWhere('categories.name', 'like', '%' . $keyword . '%');
                });
            }
            $field = 'promote_ads.id';
            $value = 'desc';
            if ($sortby) {
                try {
                    $sort = explode('-', $sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'price';
                    } else {
                        $field = 'promote_ads.id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $urgentAds->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            } else {
                $urgentAds->orderBy($field, $value);
            }

            //check price keyword
            if ($price_min) {
                $urgentAds->where('price', '>=', $price_min);
            }
            if ($price_max) {
                $urgentAds->where('price', '<=', $price_max);
            }

            //remove other promote paid ads
            $pinAds_id = array_column($data['pinAds']->toArray(), 'ads_id');
            $promoteAdPosts_id = array_merge($pinAds_id);
            // $urgentAds->whereNotIn('products.id', $promoteAdPosts_id);

            $data["urgentAds"] = $urgentAds->inRandomOrder()->where('products.status', 'active')->where('promote_ads.status', 1)->selectRaw("products.title, products.id,products.slug,packages.slug as promote_slug,packages.id as promote_id,products.feature_image,products.price, sale_type, post_type, ads_id, packages.ribbon, states.name as state_name, categories.name as category_name, users.name,users.username, memberships.name as membership_name, memberships.ribbon as membership_ribbon")->get();


            //get highlights promote ads by category
            $highlightAds = PromoteAds::join("users", "users.id", "promote_ads.user_id")->leftJoin("memberships", "memberships.slug", "users.membership")->join("products", "products.id", "promote_ads.ads_id")->join("states", "states.id", "products.state_id")->join("categories", "categories.id", "products.subcategory_id")->join("packages", "packages.id", "promote_ads.package_id")->where('package_id', 2)->where('start_date', '<=', now())->where('end_date', '>=', now());

            if ($category_id) {
                $highlightAds->where(function ($q) use ($category_id) {
                    $q->orWhere('products.category_id', $category_id)->orWhere('products.subcategory_id', $category_id);
                });
            }

            if ($request->member) {
                $highlightAds->where('users.membership', $member);
            }
            if ($state_id) {
                $highlightAds->where('state_id', $state_id);
            }
            if ($city_id) {
                $highlightAds->where('city_id', $city_id);
            }

            //check variation
            if (count($productsFilter) > 0) {
                $highlightAds->whereIn('products.id', $productsFilter);
            }

            if ($keyword) {
                $highlightAds->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')->orWhere('categories.name', 'like', '%' . $keyword . '%');
                });
            }

            $field = 'promote_ads.id';
            $value = 'desc';
            if ($sortby) {
                try {
                    $sort = explode('-', $sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'price';
                    } else {
                        $field = 'promote_ads.id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $highlightAds->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            } else {
                $highlightAds->orderBy($field, $value);
            }

            //check price keyword
            if ($price_min) {
                $highlightAds->where('price', '>=', $price_min);
            }
            if ($price_max) {
                $highlightAds->where('price', '<=', $price_max);
            }
            //remove promote paid ads
            $pinAds_id = array_column($data['pinAds']->toArray(), 'ads_id');
            $urgentAds_id = array_column($data['urgentAds']->toArray(), 'ads_id');
            $promoteAdPosts_id = array_merge($pinAds_id, $urgentAds_id);
            // $highlightAds->whereNotIn('products.id', $promoteAdPosts_id);
            // dd( $promoteAdPosts_id);
            // dd($highlightAds->get());
            $data["highlightAds"] = $highlightAds->inRandomOrder()->where('products.status', 'active')->where('promote_ads.status', 1)->selectRaw("products.title, products.id,products.slug,packages.slug as promote_slug,packages.id as promote_id,products.feature_image,products.price, sale_type, post_type, ads_id, packages.ribbon, states.name as state_name, categories.name as category_name, users.name,users.username, memberships.name as membership_name, memberships.ribbon as membership_ribbon")->get();

            //get fast promote ads by category
            $fastAds = PromoteAds::join("users", "users.id", "promote_ads.user_id")->leftJoin("memberships", "memberships.slug", "users.membership")->join("products", "products.id", "promote_ads.ads_id")->join("states", "states.id", "products.state_id")->join("categories", "categories.id", "products.subcategory_id")->join("packages", "packages.id", "promote_ads.package_id")->where('package_id', 1)->where('start_date', '<=', now())->where('end_date', '>=', now());

            if ($category_id) {
                $fastAds->where(function ($q) use ($category_id) {
                    $q->orWhere('products.category_id', $category_id)->orWhere('products.subcategory_id', $category_id);
                });
            }
            if ($request->member) {
                $fastAds->where('users.membership', $member);
            }
            if ($state_id) {
                $fastAds->where('state_id', $state_id);
            }
            if ($city_id) {
                $fastAds->where('city_id', $city_id);
            }
            if ($keyword) {
                $fastAds->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')->orWhere('categories.name', 'like', '%' . $keyword . '%');
                });
            }
            //check variation
            if (count($productsFilter) > 0) {
                $fastAds->whereIn('products.id', $productsFilter);
            }
            $field = 'promote_ads.id';
            $value = 'desc';
            if ($sortby) {
                try {
                    $sort = explode('-', $sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'price';
                    } else {
                        $field = 'promote_ads.id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $fastAds->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            } else {
                $fastAds->orderBy($field, $value);
            }

            //check price keyword
            if ($price_min) {
                $fastAds->where('price', '>=', $price_min);
            }
            if ($price_max) {
                $fastAds->where('price', '<=', $price_max);
            }
            //remove other promote paid ads
            $pinAds_id = array_column($data['pinAds']->toArray(), 'ads_id');
            $urgentAds_id = array_column($data['urgentAds']->toArray(), 'ads_id');
            $highlightAds_id = array_column($data['highlightAds']->toArray(), 'ads_id');
            $promoteAdPosts_id = array_merge($pinAds_id, $urgentAds_id, $highlightAds_id);
            // $fastAds->whereNotIn('products.id', $promoteAdPosts_id);

            $data["fastAds"] = $fastAds->inRandomOrder()->where('products.status', 'active')->where('promote_ads.status', 1)->selectRaw("products.title, products.id,products.slug,packages.slug as promote_slug,packages.id as promote_id,products.feature_image,products.price, sale_type, post_type, ads_id, packages.ribbon, states.name as state_name, categories.name as category_name, users.name,users.username, memberships.name as membership_name, memberships.ribbon as membership_ribbon")->get();
        }

        //get free ads
        $products = Product::with(["get_state"])->join("users", "users.id", "products.user_id")->join("categories", "categories.id", "products.subcategory_id")->leftJoin("memberships", "memberships.slug", "users.membership")->where('products.status', 'active');

        if ($ads_duration) {
            $products->where('approved', '>=', $ads_duration);
        }

        if ($category_id) {
            $products->where(function ($query) use ($category_id) {
                $query->where('products.category_id', $category_id)->orWhere('products.subcategory_id', $category_id)->orWhere('childcategory_id', $category_id);
            });
        }

        if ($request->member) {
            $products->where('users.membership', $member);
        }

        if ($state_id) {
            $products->where('state_id', $state_id);
        }
        if ($city_id) {
            $products->where('city_id', $city_id);
        }

        //check search keyword
        if ($request->q) {
            $products->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')->orWhere('categories.name', 'like', '%' . $keyword . '%');
            });
        }

        //period ratting
        if ($request->period) {
            if ($request->period == 'hour') {
                $period =  Carbon::parse(now())->subHours(2);
            } else {
                $period =  Carbon::parse(now())->subDays(3);
            }
            $products->where('approved', '>=', $period);
        }

        //check brand
        if ($request->brand) {
            if (!is_array($request->brand)) { // direct url tags
                $brand = explode(',', $request->brand);
            } else { // filter by ajax
                $brand = implode(',', $request->brand);
            }
            $products->whereHas('get_brand', function ($query) use ($brand) {
                $query->whereIn('slug', $brand);
            });
        }
        $field = 'products.id';
        $value = 'desc';
        if (isset($request->sortby) && $request->sortby) {
            try {
                $sort = explode('-', $request->sortby);
                if ($sort[0] == 'name') {
                    $field = 'title';
                } elseif ($sort[0] == 'price') {
                    $field = 'price';
                } else {
                    $field = 'id';
                }
                $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                $products->orderBy($field, $value);
            } catch (\Exception $exception) {
            }
        }
        $products->orderBy($field, $value);

        //check price keyword
        if ($request->price_min) {
            $products->where('price', '>=', $request->price_min);
        }
        if ($request->price_max) {
            $products->where('price', '<=', $request->price_max);
        }
        //check variation
        if (count($productsFilter) > 0) {
            $products->whereIn('products.id', $productsFilter);
        }

        //get all promote paid ads
        if ($request->ad) {
            $products->join("promote_ads", "promote_ads.ads_id", "products.id")->where('promote_ads.start_date', '<=', now())->where('promote_ads.end_date', '>=', now())->groupBy("products.id");
        }

        //get product id for Category states count post
        $get_products = $products->selectRaw('title,products.id,products.slug,price,brand_id,categories.name as category_name, state_id,views,post_type,sale_type, products.user_id, feature_image,products.created_at,approved, users.name,users.username, memberships.name as membership_name, memberships.ribbon as membership_ribbon')->get()->toArray();
        $product_id = array_column($get_products, 'id');

        if (!$request->ad) {
            //remove promote paid ads
            $pinAds_id = array_column($data['pinAds']->toArray(), 'ads_id');
            $urgentAds_id = array_column($data['urgentAds']->toArray(), 'ads_id');
            $highlightAds_id = array_column($data['highlightAds']->toArray(), 'ads_id');
            $fastAds_id = array_column($data['fastAds']->toArray(), 'ads_id');
            $promoteAdPosts_id = array_merge($pinAds_id, $urgentAds_id, $highlightAds_id, $fastAds_id);

            $products->whereNotIn('products.id', $promoteAdPosts_id);
        }
        //check perPage
        $promoteAds = count($data['pinAds']) + count($data['urgentAds']) + count($data['highlightAds']) + count($data['fastAds']);



        foreach ($products->get() as $product) {
            // Check if membership_name is null
            if ($product->membership_name === null) {
                // Set the key to 'non_verified_bonik'
                $key = 'non_verified_bonik';
            } else {
                // Set the key to the value of membership_name
                $key = 'verified_bonik';
            }

            // Check if the key already exists in the $data array
            if (!isset($data[$key])) {
                // If not, initialize it as an empty array
                $data[$key] = [];
            }

            // Append the product to the array under the appropriate key
            $data[$key][] = $product;
        }




        //check perPage
        $perPage = 19 - $promoteAds;
        if (isset($request->perPage) && $request->perPage) {
            $perPage = $request->perPage - $promoteAds;
        }
        $data['products'] = $products->paginate($perPage);
        $items = $this->generateItemListing($data);
dd($items);
        if ($request->filter) {
            if ($request->is('api/*')) {
                return response()->json($data);
            } else {
                return view('frontend.post-filter')->with($data);
            }
        } else {

            $data['get_category'] = Category::with(['get_subcategory' => function ($query) use ($product_id) {
                $query->withCount(['productsBySubcategory' => function ($query) use ($product_id) {
                    $query->whereIn('id', $product_id);
                }]);
            }])->withCount(['productsByCategory' => function ($query) use ($product_id) {
                $query->whereIn('id', $product_id);
            }])->whereNull('parent_id')->orderBy('products_by_category_count', 'desc')->where('status', 1)->get();

            $data['states']  =  State::with(
                ['get_city' => function ($query) use ($product_id) {
                    $query->withCount(['productsByCity' => function ($query) use ($product_id) {
                        $query->whereIn('id', $product_id);
                    }]);
                }]
            )->withCount(['productsByState' => function ($query) use ($product_id) {
                $query->whereIn('id', $product_id);
            }])->orderBy('products_by_state_count', 'desc')->get();

            $data['brands'] =  Brand::join('products', 'brands.id', 'products.brand_id')->groupBy('brand_id')->where('brands.status', 1)->where('products.category_id', $category_id)->orderBy('brands.position', 'asc')->selectRaw('brands.*')->get();

            if ($request->is('api/*')) {
                return response()->json($data);
            } else {
                return view('frontend.category-details')->with($data);
            }
        }
    }
    private function generateItemListing($data)
    {
        $data['vbp'] = [];
        foreach ($data['verified_bonik'] as $item) {
            $data['vbp'][] = $item->toArray();
        }

        $data['nvbp'] = [];
        foreach ($data['non_verified_bonik'] as $item) {
            $data['nvbp'][] = $item->toArray();
        }

        // Combine ad listings and post listings into one array
        $allListings = [
            "pinAds" => isset($data['pinAds']) ? $data['pinAds']->toArray() : [],
            "urgentAds" => isset($data['urgentAds']) ? $data['urgentAds']->toArray() : [],
            "highlightAds" => isset($data['highlightAds']) ? $data['highlightAds']->toArray() : [],
            "fastAds" => isset($data['fastAds']) ? $data['fastAds']->toArray() : [],
            "vbp" => isset($data['vbp']) ? $data['vbp'] : [],
            "nvbp" => isset($data['nvbp']) ? $data['nvbp'] : [],
        ];

        // Initialize the sorted ads array
        $sortedAds = [];

        // Define the sorting pattern
        $sortingPattern = [
            'pinAds', 'urgentAds', 'highlightAds', 'fastAds' // Ads types
        ];

        // Loop through the sorting pattern
        foreach ($sortingPattern as $type) {
            // Add ads to the sortedAds array
            if (isset($allListings[$type]) && count($allListings[$type]) > 0) {
                $sortedAds = array_merge($sortedAds, array_splice($allListings[$type], 0, 2));
                // Add two verified boniks
                $sortedAds = array_merge($sortedAds, array_splice($allListings['vbp'], 0, 2));
                // Add two non-verified boniks
                $sortedAds = array_merge($sortedAds, array_splice($allListings['nvbp'], 0, 2));
            }
        }

        // Append any remaining products to the sorted list
        foreach ($allListings as $type => $items) {
            $sortedAds = array_merge($sortedAds, $items);
        }

        // Output the sorted list of ads
        // dd($sortedAds);
        return $sortedAds;
    }





    //product show by category
    public function location(Request $request, $location, string $catslug = null)
    {
        $data['products'] = $data['banners'] = $data['product_variations'] = $data['category'] = $data['filterCategories'] = $data['brands'] = [];

        try {

            $data['state'] = State::with(['get_city' => function ($query) {
                $query->withCount('productsByCity');
            }])
                ->withCount('productsByState')->where('states.slug', $location)->leftJoin('cities', 'states.id', 'cities.state_id')->orWhere('cities.slug', $location)->orderBy('states.name as state_name', 'asc')->selectRaw('states.*')->first();

            $category = Category::with(['get_subcategory' => function ($query) {
                $query->withCount('productsBySubcategory');
            }]);
            if ($catslug) {
                $category->where('slug', $catslug);
            }
            $data['category'] = $category->first();

            if (!$data['category']) {
                return view('frontend.pages.category-sitemap');
            }
            $category_id = $data['category']->id;
            //get promote ads by category
            $data['promoteAdPosts'] = PromoteAds::with(['get_adPost', 'get_adPackage'])->whereHas('get_adPost', function ($query) use ($category_id) {
                $query->where('status', 'active')->where(function ($q) use ($category_id) {
                    $q->orWhere('category_id', $category_id)->orWhere('subcategory_id', $category_id);
                });
            })->where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 1)->get();

            $products = Product::where(function ($query) use ($category_id) {
                $query->where('category_id', $category_id)
                    ->orWhere('subcategory_id', $category_id)
                    ->orWhere('childcategory_id', $category_id);
            });

            // $products = Product::where(function($query) use ($category_id){
            // $query->where('state_id', $category_id)
            //     ->orWhere('subcategory_id', $category_id )
            //     ->orWhere('childcategory_id', $category_id);
            // });


            //recent views set category id
            $recent_catId = $data['category']->id;
            $recentViews = (Cookie::has('recentViews') ? json_decode(Cookie::get('recentViews')) :  []);
            $recentViews = array_merge([$recent_catId], $recentViews);
            $recentViews = array_values(array_unique($recentViews)); //reindex & remove duplicate value
            Cookie::queue('recentViews', json_encode($recentViews), time() + (86400));

            //check search keyword
            if ($request->q) {
                $products->where('title', 'like', '%' . $request->q . '%');
            }

            //check ratting
            if ($request->ratting) {
                $products->where('avg_ratting', $request->ratting);
            }

            //check brand
            if ($request->brand) {
                if (!is_array($request->brand)) { // direct url tags
                    $brand = explode(',', $request->brand);
                } else { // filter by ajax
                    $brand = implode(',', $request->brand);
                }
                $products->whereIn('brand_id', $brand);
            }
            $field = 'id';
            $value = 'desc';
            if (isset($request->sortby) && $request->sortby) {
                try {
                    $sort = explode('-', $request->sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'price';
                    } else {
                        $field = 'id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $products->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            }
            $products->orderBy($field, $value);

            //check price keyword
            if ($request->price_min) {
                $products->where('price', '>=', $request->price_min);
            }
            if ($request->price_max) {
                $products->where('price', '<=', $request->price_max);
            }

            //check perPage
            $perPage = 3;
            if (isset($request->perPage) && $request->perPage) {
                $perPage = $request->perPage;
            }

            $products->selectRaw('id,title,slug,price,brand_id,category_id,state_id,views,sale_type, feature_image,created_at')->where('status', 'active');
            //get product id for product_variations
            $get_products  = $products->get()->toArray();
            $product_id = array_column($get_products, 'id');

            $data['product_variations'] = ProductAttribute::with(['get_attrValues' => function ($query) {
                $query->withCount('get_variantProducts');
            }])->where('category_id', $category_id)
                ->get();

            //check weather ajax request identify filter parameter
            foreach ($data['product_variations'] as $filterAttr) {
                $filter = strtolower(str_replace(' ', '', $filterAttr->name));

                if ($request->$filter) {

                    if (!is_array($request->$filter)) { // direct url tags
                        $tags = explode(',', $request->$filter);
                    } else { // filter by ajax
                        $tags = implode(',', $request->$filter);
                    }
                    //get product id from url filter id (size=1,2)
                    $productsFilter = ProductVariationDetails::join('product_attribute_values', 'product_variation_details.variation_id', 'product_attribute_values.id')->whereIn('name', $tags)->groupBy('product_id')->get()->pluck('product_id');

                    $products->whereIn('id', $productsFilter);
                }
            }

            $data['products'] = $products->paginate($perPage);
        } catch (\Exception $e) {
        }

        if ($request->filter) {
            return view('frontend.post-filter')->with($data);
        } else {
            if ($data['category']) {
                $data['banners'] = Banner::where('page_name', $data['category']->slug)->where('status', 1)->get();
                $data['brands'] =  Brand::join('products', 'brands.id', 'products.brand_id')->groupBy('brand_id')->where('brands.status', 1)->where('products.category_id', $data['category']->id)->orderBy('brands.position', 'asc')->selectRaw('brands.*')->get();
            }
            return view('frontend.ads-location')->with($data);
        }
    }
    //search products
    public function search(Request $request)
    {

        $data['products'] = $data['product_variations'] = $data['category']  = $data['brands'] = $brand_id = $childcategory_id = [];

        try {
            $products = Product::where('products.status', 'active');
            $keywords = request('q');
            if ($request->q) {
                $products->where(function ($query) use ($keywords) {
                    $query->orWhere('title', 'like', '%' . $keywords . '%');
                    $query->orWhere('meta_keywords', 'like', '%' . $keywords . '%');
                });
            }

            //check brand
            if ($request->brand) {
                if (!is_array($request->brand)) { // direct url tags
                    $brand = explode(',', $request->brand);
                } else { // filter by ajax
                    $brand = implode(',', $request->brand);
                }
                $products->whereIn('brand_id', $brand);
            }
            $field = 'id';
            $value = 'desc';
            if (isset($request->sortby) && $request->sortby) {
                try {
                    $sort = explode('-', $request->sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'price';
                    } else {
                        $field = 'id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $products->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            }
            $products->orderBy($field, $value);

            //check price keyword
            if ($request->price_min) {
                $products->where('price', '>=', $request->price_min);
            }
            if ($request->price_max) {
                $products->where('price', '<=', $request->price_max);
            }


            //check perPage
            $perPage = 16;
            if (isset($request->perPage) && $request->perPage) {
                $perPage = $request->perPage;
            }

            $products->selectRaw('id,title,slug,price,brand_id,category_id,state_id,views,sale_type, feature_image,created_at')->where('status', 'active');
            //get product id for product_variations
            $get_products  = $products->get()->toArray();

            $product_id = array_column($get_products, 'id');
            $brand_id = array_column($get_products, 'brand_id');
            $childcategory_id = array_column($get_products, 'childcategory_id');

            $data['product_variations'] = ProductVariation::with('allVariationValues')
                ->whereIn('product_id', $product_id)
                ->groupBy('attribute_id')
                ->get();

            //check weather ajax request identify filter parameter
            foreach ($data['product_variations'] as $filterAttr) {
                $filter = strtolower($filterAttr->attribute_name);
                if ($request->$filter) {
                    if (!is_array($request->$filter)) { // direct url tags
                        $tags = explode(',', $request->$filter);
                    } else { // filter by ajax
                        $tags = implode(',', $request->$filter);
                    }
                    //get product id from url filter id (size=1,2)
                    $productsFilter = ProductVariationDetails::whereIn('attributeValue_name', $tags)->groupBy('product_id')->get()->pluck('product_id');
                    $products = $products->whereIn('products.id', $productsFilter);
                }
            }

            $data['products'] = $products->paginate($perPage);
        } catch (\Exception $e) {
        }

        if ($request->filter) {
            return view('frontend.products.filter_products')->with($data);
        } else {
            $data['categories'] = Category::whereIn('id', $childcategory_id)->get();
            $data['brands'] = Brand::whereIn('id', $brand_id)->where('status', 1)->get();
            return view('frontend.category-details')->with($data);
        }
    }

    //display product details by product id/slug
    public function post_details(Request $request, $slug)
    {
        $data['post_detail'] = Product::with(["get_state", "get_subcategory", "get_features", "author.getMembership", "get_variations.get_variationDetails.get_attributeValue"])->where('slug', $slug)->first();

        if ($data['post_detail']) {
            //recent views set category id
            $recent_catId = ($data['post_detail']->childcategory_id) ? $data['post_detail']->childcategory_id : $data['post_detail']->subcategory_id;
            // $recentViews = (Cookie::has('recentViews') ? json_decode(Cookie::get('recentViews')) :  []);
            $recentViews = (Cookie::has('recentViews') ? json_decode(Cookie::get('recentViews')) :  []) ?? [];
            $recentViews = array_merge([$recent_catId], $recentViews);
            $recentViews = array_values(array_unique($recentViews)); //reindex & remove duplicate value
            Cookie::queue('recentViews', json_encode($recentViews), time() + (86400));

            // post view count
            $view = rand(1, 9);
            $data['post_detail']->increment('views', $view);

            $related_products = Product::where('status', 'active');

            //show membership user post OR show category products
            if ($data['post_detail']->author && $data['post_detail']->author->membership) {
                $related_products->where("user_id", $data['post_detail']->user_id);
            } else {
                if ($data['post_detail']->subcategory_id != null) {
                    $category_feild = 'subcategory_id';
                    $category_id = $data['post_detail']->subcategory_id;
                } else {
                    $category_feild = 'category_id';
                    $category_id = $data['post_detail']->category_id;
                }
                $related_products->where($category_feild, $category_id);
            }

            //ads duration
            $ads_duration = SiteSetting::where('type', 'free_ads_limit')->first();
            $ads_duration =  Carbon::parse(now())->subDays($ads_duration->value2);
            if ($ads_duration) {
                $related_products->where('approved', '>=', $ads_duration);
            }

            $data['related_products'] = $related_products->where('id', '!=', $data['post_detail']->id)->selectRaw('id,title,slug,feature_image,price,sale_type,brand_id,category_id,subcategory_id,state_id,created_at')->inRandomOrder()->take(6)->get();

            if ($request->is('api/*')) {
                return response()->json($data);
            } else {
                return view('frontend.ads-details')->with($data);
            }
        } else {
            if ($request->is('api/*')) {
                return response()->json(["message" => 404]);
            } else {
                return view('404');
            }
        }
    }

    public function moreProducts($slug)
    {
        $data['section'] = HomepageSection::where('slug', $slug)->where('status', 1)->first();
        if ($data['section']) {
            if ($slug == 'recommended-for-you') {
                $data['products'] = Product::with(['brand_id', 'offer_discount.offer:id'])->where('status', 'active')->selectRaw('id,title,selling_price,discount,discount_type, slug,brand_id, feature_image')->orderBy('views', 'desc')->paginate(16);
            } else {
                $data['products'] = Product::with('offer_discount.offer:id')->whereIn('id', explode(',', $data['section']->product_id))->orderBy('id', 'desc')->where('status', 'active')->paginate(16);
            }
            return view('frontend.homepage.moreProducts')->with($data);
        }
        return view('frontend.404');
    }

    public function quickview(Request $request, $slug)
    {
        $data['product'] = Product::with('user:id,name', 'get_category:id,name', 'get_features')->where('slug', $slug)->first();
        $data['type'] = ($request->type) ? $request->type : 'on';
        $data['offer'] = $request->offer ? $request->offer : null;
        if ($data['product']) {
            return view('frontend.products.quickview-iframe')->with($data);
        } else {
            return 'Product not found.';
        }
    }

    public function Categories(){
        $data['regions'] = State::with("get_city")->orderBy('position', 'desc')->where('status', 1)->get();
        $data['categories'] = Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get();
        return $data;
    }
}
