<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\ProductFeature;
use App\Models\ProductVariation;
use App\Models\ProductVariationDetails;
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\ReportReason;
use App\Models\Brand;
use App\Models\Package;
use App\Models\PackageValue;
use App\Models\PackagePurchase;
use App\Models\PromoteAds;
use App\Models\PredefinedFeature;
use App\Models\PaymentGateway;
use App\Models\SiteSetting;
use App\Traits\CreateSlug;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use CreateSlug;
    public function index(Request $request, string $status = null)
    {
        $posts = Product::with('get_promotePackage')->withCount(["messages", "reports", "reacts"])->where('user_id', Auth::id())->whereNotIn('status', ['not posted'])->orderBy('id', 'desc');

        if ($status) {
            if ($status == 'image-missing') {
                $posts->where('feature_image', null);
            } else {
                $posts->where('status', $status);
            }
        }

        if (!$status && $request->status && $request->status != 'all') {
            $posts->where('status', $request->status);
        }
        if ($request->title) {
            $posts->where('title', 'LIKE', '%' . $request->title . '%');
        }
        $data['posts'] = $posts->paginate(15);
        $data['reasons'] = ReportReason::where('type', 'product-delete')->where('status', 1)->get();

        if ($request->is('api/*')) {
            return response()->json($data);
        } else {
            return view('users.post.index')->with($data);
        }
    }

    public function create(Request $request, string $post_id = null, string $category = null)
    {

        $guard = $request->is('api/*') ? "api" : "web";
        $user_id = Auth::Guard($guard)->id();

        $product_id = ($post_id) ? $post_id : $this->generatePostId();

        $post = Product::with("get_galleryImages")->where("product_id", $product_id)->where("user_id", $user_id)->first();

        //insert first step category & image
        if ($request->isMethod('post') && !$category) {
            $category = Category::where('id', $request->category)->where('parent_id', '!=', null)->where('status', 1)->first();
            $category_id = ($category) ? $category->parent_id : $request->category;
            $subcategory_id = ($category) ? $request->category : null;

            //check free ads limit
            $free_ads = SiteSetting::where('type', 'free_ads_limit')->first();

            if ($free_ads->status == 1) {
                //count total free post
                $total_free_post = Product::where('subcategory_id', $subcategory_id)->where('user_id', $user_id)->where('ad_type', 'free')->count();
                //check post limit
                $free_ads_limit = (Auth::guard($guard)->user()->membership) ? 100 : (($category->free_ads_limit > 0) ? $category->free_ads_limit : 10);

                if ($category && $total_free_post >= $free_ads_limit) {

                    if ($request->is('api/*')) {
                        return response()->json(['error' => 'Your post limit over.', 'input' => $request->all()], 422);
                    } else {
                        Toastr::error("Your post limit over.");
                        return back()->withInput();
                    }
                }
            }
            // Insert or update post
            if (!$post) {
                $post = new Product();
                $post->product_id = $product_id;
                $post->user_id = $user_id;
                $post->post_type = $request->post_type;
                $post->status = "not posted";
            }

            $post->category_id = $category_id;
            $post->subcategory_id = $subcategory_id;
            $city = City::where("id", $request->location)->first();
            $post->state_id = $city->state_id;
            $post->city_id = $city->id;
            //if feature image set
            if ($request->hasFile('feature_image')) {
                $image = $request->file('feature_image');
                $image_name = $this->uniqueImagePath('products', 'feature_image', time() . rand(0000, 9999) . '.' . $image->getClientOriginalExtension());

                //thumb image Resize
                $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(200, 150);
                $img->save(public_path('upload/images/product/thumb/' . $image_name));

                //Resize image
                $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(670, 475, 'center', false, 'e7ecee');

                if (config('siteSetting.watermark')) {
                    //Add water mark in image
                    $watermark = Image::make(public_path('upload/images/logo/' . config('siteSetting.watermark')));
                    $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                    $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                    $resizePercentage = 50; //0% less then an actual image (play with this value)
                    $watermarkSize = round(290); //watermark will be $resizePercentage less then the actual width of the image
                    $watermark->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    //insert resized watermark to image center aligned
                    $img->insert($watermark->opacity(50), 'bottom-right');
                    //watermark end
                }
                //save image
                $img->save(public_path('upload/images/product/' . $image_name));

                $post->feature_image = $image_name;
            }

            $post->save();

            //delete old images
            ProductImage::where("product_id", $product_id)->delete();
            // gallery Image upload
            if ($request->hasFile('gallery_image')) {
                $gallery_image = $request->file('gallery_image');
                foreach ($gallery_image as $image) {
                    $new_image_name = $this->uniqueImagePath('product_images', 'image_path', time() . rand(0000, 9999) . '.' . $image->getClientOriginalExtension());

                    //Resize image
                    $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function ($constraint) {
                        $constraint->aspectRatio();
                    })->resizeCanvas(670, 475, 'center', false, 'e7ecee');

                    if (config('siteSetting.watermark')) {
                        //Add water mark in image
                        $watermark = Image::make(public_path('upload/images/logo/' . config('siteSetting.watermark')));
                        $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                        $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                        $resizePercentage = 50; //0% less then an actual image (play with this value)
                        $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                        // resize watermark width keep height auto
                        $watermark->resize(150, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        //insert resized watermark to image center aligned
                        $img->insert($watermark->opacity(50), 'bottom-right');
                        //watermark end
                    }
                    //save image
                    $img->save(public_path('upload/images/product/gallery/' . $new_image_name));
                    ProductImage::create([
                        'product_id' => $product_id,
                        'image_path' => $new_image_name,
                        'title' => $new_image_name
                    ]);
                }
            }

            if($request->is('api/*')){
                return response()->json(['product_id' => $product_id, 'category_slug' => $category->slug]);
            }else{
                return redirect()->route('post.create', [$product_id, $category->slug]);
            }
           
        }

        //second step show post variation & features
        if ($category && $post) {
            $data['post'] = $post;
            $category_id = ($post->category_id) ? $post->category_id : 0;
            $subcategory_id = ($post->subcategory_id) ? $post->subcategory_id : 0;

            $data['attributes'] = ProductAttribute::with('get_attrValues')->whereIn('category_id', ['all', $category_id, $subcategory_id])->where('status', 1)->get();
            $data['features'] = PredefinedFeature::whereIn('category_id', ['all', $category_id, $subcategory_id])->where('status', 1)->get();

            $data['brands'] = Brand::orderBy('name', 'asc')->whereIn('category_id', ['all', $category_id, $subcategory_id])->where('status', 1)->get();
            $data['category'] = Category::where('id', $post->subcategory_id)->where('status', 1)->first();
            $data['location'] = City::with("state")->where("id", $post->city_id)->first();
            $data['chilcategories'] = Category::where('parent_id', $subcategory_id)->where('status', 1)->get();
            $data['packageTypes'] = Package::with([
                'get_packageVlues' => function ($query) use ($category_id, $subcategory_id) {
                    $query->whereIn('category_id', [$category_id, $subcategory_id])->where('ads', 1)->where('status', 1);
                },

                'get_purchasePackages' => function ($query) use ($category_id, $subcategory_id) {
                    $query->whereIn('category_id', [$category_id, $subcategory_id])->where('remaining_ads', '>=', 1)->where('payment_status', 'paid')->where('user_id',  Auth::id());
                }
            ])->where('status', 1)->get();

            $data['get_category'] = Category::with('get_subcategory')->whereNull('parent_id')->where('status', 1)->get();
            $data['states'] =  State::with('get_city')->orderBy('position', 'desc')->get();
            
            if($request->is('api/*')){
                return response()->json(['data' => $data]);
            }else{
                return view('users.post.ad-post')->with($data);
            }
        }

        $data['regions'] = State::with("get_city")->orderBy('position', 'desc')->where('status', 1)->get();

        $data['categories'] = Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get();

        $data['paymentgateways'] = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->get();
       

        if($request->is('api/*')){
            return response()->json(['data' => $data]);
        }else{
            return view('users.post.ads-category')->with($data);
        }
    }

    //store new post
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'post_id' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }


        $guard = $request->is('api/*') ? "api" : "web";
        $user_id = Auth::guard($guard)->id();
        $product_id = $request->post_id;
        $post = Product::where("product_id", $product_id)->where("user_id", $user_id)->first();

        $post->title = $request->title;
        $post->slug = $this->createSlug('products', $request->title);
        $post->description = $request->description;
        $post->childcategory_id = ($request->childcategory_id) ? $request->childcategory_id : null;
        $post->brand_id = ($request->brand ? $request->brand : null);
        $post->price = ($request->price) ? $request->price : 0;
        $post->negotiable = ($request->negotiable ? 1 : 0);
        $post->sale_type = ($request->sale_type ? $request->sale_type : null);
        $post->contact_name = ($request->contact_name) ? $request->contact_name : null;
        $post->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
        $post->contact_email = ($request->contact_email) ? $request->contact_email : null;
        $post->contact_hidden = ($request->contact_hidden) ? 1 : 0;
        $post->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
        $post->user_id = $user_id;
        $post->created_by = $user_id;
        //check ads auto active
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();
        $post->status = ($product_active) ? 'pending' : 'active';
        $store = $post->save();

        if ($store) {
            //insert variation
            if ($request->attribute) {
                foreach ($request->attribute as $attribute_id => $attr_value) {
                    //insert product variation
                    $variation = new ProductVariation();
                    $variation->product_id = $post->id;
                    $variation->attribute_id = $attribute_id;
                    $variation->attribute_name = $attr_value;
                    $variation->in_display = 1;
                    $variation->save();
                    if (isset($request->attributeValue) && array_key_exists($attribute_id, $request->attributeValue)) {
                        for ($i = 0; $i < count($request->attributeValue[$attribute_id]); $i++) {
                            $quantity = 0;
                            //check weather attribute value set
                            if (array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {

                                $feature_details = new ProductVariationDetails();
                                $feature_details->product_id = $post->id;
                                $feature_details->attribute_id = $attribute_id;
                                $feature_details->variation_id = $variation->id;
                                $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                                $feature_details->save();
                            }
                        }
                    }
                }
            }
            //insert additional Feature data
            if ($request->features) {
                try {
                    foreach ($request->features as $feature_id => $feature_name) {
                        if ($request->featureValue[$feature_id]) {
                            $extraFeature = new ProductFeature();
                            $extraFeature->product_id = $post->id;
                            $extraFeature->feature_id = $feature_id;
                            $extraFeature->name = $feature_name;
                            $extraFeature->value = $request->featureValue[$feature_id];
                            $extraFeature->save();
                        }
                    }
                } catch (Exception $exception) {
                }
            }

            if($request->is('api/*')){
                return response()->json(['slug' => [$post->slug], "message" => "Post create successfully. Your post under review"]);
            }
            else{
                Toastr::success('Post create successfully. Your post under review');
                //redirect payment page for payment
                return redirect()->route('ads.promotePackage', [$post->slug])->with('success', 'Post create successfully. Your post under review');
            }
          
        } else {
            return handleResponse('Error',$request,'Post Cannot Create.!');
        }
        return back();
    }

    //store wanted ad post
    public function storeWantedPost(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }

        $category = Category::where('id', $request->category)->where('parent_id', '!=', null)->where('status', 1)->first();
        $category_id = ($category) ? $category->parent_id : $request->category;
        $subcategory_id = ($category) ? $request->category : null;

        $guard = $request->is('api/*') ? "api" : "web";
        $user_id = Auth::Guard($guard)->id();

        $product_id = $this->uniqueOrderId('products', 'product_id');

        $post = new Product();
        $post->product_id = $product_id;
        $post->user_id = $user_id;
        $post->post_type = $request->post_type;
        $post->title = $request->title;
        $post->slug = $this->createSlug('products', $request->title);
        $post->category_id = $category_id;
        $post->subcategory_id = $subcategory_id;

        $city = City::where("id", $request->location)->first();
        $post->state_id = $city->state_id;
        $post->city_id = $city->id;

        $post->description = $request->description;
        $post->price = ($request->price) ? $request->price : 0;
        $post->negotiable = 1;
        $post->contact_name = ($request->contact_name) ? $request->contact_name : null;
        $post->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
        $post->contact_email = ($request->contact_email) ? $request->contact_email : null;
        $post->contact_hidden = ($request->contact_hidden) ? 1 : 0;
        $post->user_id = $user_id;
        $post->created_by = $user_id;
        //check ads auto active
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();
        $post->status = ($product_active) ? 'pending' : 'active';

        //if feature image set
        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $image_name = $this->uniqueImagePath('products', 'feature_image', $request->title . '.' . $image->getClientOriginalExtension());

            //thumb image Resize
            $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(200, 150);
            $img->save(public_path('upload/images/product/thumb/' . $image_name));

            //Resize image
            $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(670, 475, 'center', false, 'e7ecee');

            if (config('siteSetting.watermark')) {
                //Add water mark in image
                $watermark = Image::make(public_path('upload/images/logo/' . config('siteSetting.watermark')));
                $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                $resizePercentage = 50; //0% less then an actual image (play with this value)
                $watermarkSize = round(290); //watermark will be $resizePercentage less then the actual width of the image
                $watermark->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //insert resized watermark to image center aligned
                $img->insert($watermark->opacity(50), 'bottom-right');
                //watermark end
            }
            //save image
            $img->save(public_path('upload/images/product/' . $image_name));

            $post->feature_image = $image_name;
        }

        $store = $post->save();

        if ($store) {
            $message = "Post create successfully. Your post under review";
            return  handleResponse('success', $request, $message, ['case' => 3, 'url' => 'post.list', 'message' => $message]);
        } else {
            return handleResponse('error',$request,'Post Cannot Create.!');
        }
        return back();
    }

    //update wanted ad post
    public function updateWantedPost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return handleValidationResponse($request, $validator);
        }

        $category = Category::where('id', $request->category)->where('parent_id', '!=', null)->where('status', 1)->first();
        $category_id = ($category) ? $category->parent_id : $request->category;
        $subcategory_id = ($category) ? $request->category : null;

        $guard = $request->is('api/*') ? "api" : "web";
        $user_id = Auth::Guard($guard)->id();

        $post = Product::find($id);

        $post->title = $request->title;
        $post->category_id = $category_id;
        $post->subcategory_id = $subcategory_id;

        $city = City::where("id", $request->location)->first();
        $post->state_id = $city->state_id;
        $post->city_id = $city->id;

        $post->description = $request->description;
        $post->contact_name = ($request->contact_name) ? $request->contact_name : null;
        $post->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile) : null;
        $post->contact_email = ($request->contact_email) ? $request->contact_email : null;
        $post->contact_hidden = ($request->contact_hidden) ? 1 : 0;
        //check ads auto active
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();
        if ($product_active) {
            $post->status = ($post->status == 'active') ? 'pending' : $post->status;
        }
        //if feature image set
        if ($request->hasFile('feature_image')) {

            $getimage_path = public_path('upload/images/product/' . $post->feature_image);
            if (file_exists($getimage_path) && $post->feature_image) {
                unlink($getimage_path);
                unlink(public_path('upload/images/product/thumb/' . $post->feature_image));
            }

            $image = $request->file('feature_image');
            $image_name = $this->uniqueImagePath('products', 'feature_image', $request->title . '.' . $image->getClientOriginalExtension());

            //thumb image Resize
            $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(200, 150);
            $img->save(public_path('upload/images/product/thumb/' . $image_name));

            //Resize image
            $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(670, 475, 'center', false, 'e7ecee');

            if (config('siteSetting.watermark')) {
                //Add water mark in image
                $watermark = Image::make(public_path('upload/images/logo/' . config('siteSetting.watermark')));
                $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                $resizePercentage = 50; //0% less then an actual image (play with this value)
                $watermarkSize = round(290); //watermark will be $resizePercentage less then the actual width of the image
                $watermark->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //insert resized watermark to image center aligned
                $img->insert($watermark->opacity(50), 'bottom-right');
                //watermark end
            }
            //save image
            $img->save(public_path('upload/images/product/' . $image_name));

            $post->feature_image = $image_name;
        }

        $store = $post->save();

        if ($store) {
            $message = "Post update successfully.";
            return  handleResponse('success', $request, $message, ['case' => 3, 'url' => 'post.list', 'message' => $$message]);
        } else {
            return handleResponse('error',$request,'Post Cannot Update.!');
        }
        return back();
    }

    //edit post
    public function edit(Request $request,$slug)
    {
        $data['post'] = Product::with('get_galleryImages')->where('slug', $slug)->where('user_id', Auth::id())->first();
        $product_id = $data['post']->id;

        if ($data['post']) {
            //if post type wanted
            if ($data['post']->post_type == "wanted") {
                $data['regions'] = State::with("get_city")->orderBy('position', 'desc')->where('status', 1)->get();

                $data['categories'] = Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('position', 'asc')->where('status', 1)->get();
                if($request->is('api/*')){
                   return response()->json(["data" => $data]);
                }

                else{
                    return view('users.post.wanted-post-edit')->with($data);
                }
              
            }


            $subcategory_id = 0;
            if ($data['post']->category_id) {
                $category_id = $data['post']->category_id;
            }

            $data['subcategory'] = Category::where('id', $data['post']->subcategory_id)->where('status', 1)->first();

            if ($data['post']->subcategory_id) {
                $subcategory_id = $data['post']->subcategory_id;
            }


            $data['category'] = Category::where('id', $data['post']->subcategory_id)->where('status', 1)->first();
            $data['location'] = City::with("state")->where("id", $data['post']->city_id)->first();

            $data['attributes'] = ProductAttribute::with(['get_attrValues.get_productVariant' => function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            }])->whereIn('category_id', ['all', $category_id, $subcategory_id])->where('status', 1)->get();

            $data['features'] = PredefinedFeature::with(['featureValue' => function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            }])->whereIn('category_id', ['all', $category_id, $subcategory_id])->where('status', 1)->get();
            $data['regions'] = State::orderBy('name', 'asc')->where('status', 1)->get();
            $data['cities'] = City::where('state_id', $data['post']->state_id)->orderBy('name', 'asc')->where('status', 1)->get();
            $data['brands'] = Brand::orderBy('name', 'asc')->whereIn('category_id', ['all', $category_id, $subcategory_id])->where('status', 1)->get();
            $data['chilcategories'] = Category::where('parent_id', $subcategory_id)->where('status', 1)->get();

            $data['packageTypes'] = Package::with([
                'get_packageVlues' => function ($query) use ($category_id, $subcategory_id) {
                    $query->whereIn('category_id', [$category_id, $subcategory_id])->where('ads', 1)->where('status', 1);
                },

                'get_purchasePackages' => function ($query) use ($category_id, $subcategory_id) {
                    $query->whereIn('category_id', [$category_id, $subcategory_id])->where('remaining_ads', '>=', 1)->where('payment_status', 'paid')->where('user_id',  Auth::id());
                }
            ])->where('status', 1)->get();


            if($request->is('api/*')){
                return response()->json(["data" => $data]);
             }else{
                return view('users.post.ad-post-edit')->with($data);
             }
           
        }

        return view('404');
    }

    //update new post
    public function update(Request $request, int $product_id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
        ]);
        $user_id = Auth::id();
        $product_active = SiteSetting::where('type', 'product_activation')->where('status', 1)->first();

        // update post
        $data = Product::where('id', $product_id)->where('user_id', Auth::id())->first();
        if ($data) {
            $data->title = $request->title;
            $data->description = $request->description;
            $data->childcategory_id = ($request->childcategory_id ? $request->childcategory_id : null);
            $data->brand_id = ($request->brand ? $request->brand : null);
            $data->price = $request->price;
            $data->negotiable = ($request->negotiable ? 1 : 0);
            $data->sale_type = ($request->sale_type ? $request->sale_type : null);
            $data->contact_name = ($request->contact_name) ? $request->contact_name : null;
            $data->contact_mobile = ($request->contact_mobile) ? json_encode($request->contact_mobile, true) : null;
            $data->contact_email = ($request->contact_email) ? $request->contact_email : null;
            $data->contact_hidden = ($request->contact_hidden) ? 1 : 0;
            $data->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;

            if ($product_active) {
                $data->status = ($data->status == 'active') ? 'pending' : $data->status;
            }
            $data->updated_by = Auth::id();


            //if feature image set
            if ($request->hasFile('feature_image')) {
                $getimage_path = public_path('upload/images/product/' . $data->feature_image);
                if (file_exists($getimage_path) && $data->feature_image) {
                    unlink($getimage_path);
                    unlink(public_path('upload/images/product/thumb/' . $data->feature_image));
                }

                $image = $request->file('feature_image');
                $new_image_name = $this->uniqueImagePath('products', 'feature_image', $request->title . '.' . $image->getClientOriginalExtension());

                //Resize image
                $img = Image::make($image->getRealPath())->orientate()->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(200, 150);
                $img->save(public_path('upload/images/product/thumb/' . $new_image_name));

                //Resize image
                $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(670, 475, 'center', false, 'e7edee');

                if (config('siteSetting.watermark')) {
                    //Add water mark in image
                    $watermark = Image::make(public_path('upload/images/logo/' . config('siteSetting.watermark')));
                    $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                    $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                    $resizePercentage = 50; //0% less then an actual image (play with this value)
                    $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                    // resize watermark width keep height auto
                    $watermark->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    //insert resized watermark to image center aligned
                    $img->insert($watermark->opacity(50), 'bottom-right');
                    //watermark end
                }

                //save image
                $img->save(public_path('upload/images/product/' . $new_image_name));


                $data->feature_image = $new_image_name;
            }

            $update = $data->save();

            if ($update) {

                //insert variation
                if ($request->attribute) {
                    foreach ($request->attribute as $attribute_id => $attr_value) {
                        //insert product feature name in feature table

                        $variation = ProductVariation::where('attribute_id', $attribute_id)->where('product_id', $product_id)->first();
                        if (!$variation) {
                            $variation = new ProductVariation();
                            $variation->product_id = $data->id;
                            $variation->attribute_id = $attribute_id;
                            $variation->attribute_name = $attr_value;
                            $variation->in_display = 1;
                            $variation->save();
                        }
                        if (isset($request->attributeValue) && array_key_exists($attribute_id, $request->attributeValue)) {
                            for ($i = 0; $i < count($request->attributeValue[$attribute_id]); $i++) {

                                //check weather attribute value set
                                if (array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {

                                    //delete unselected variation
                                    ProductVariationDetails::where('variation_id', $variation->id)->where('product_id', $product_id)->whereNotIn('attributeValue_name', $request->attributeValue[$attribute_id])->delete();

                                    //insert or update feature attribute details in ProductVariationDetails table
                                    $feature_details = ProductVariationDetails::where('attributeValue_name', $request->attributeValue[$attribute_id][$i])->where('product_id', $product_id)->first();

                                    if (!$feature_details) {
                                        $feature_details = new ProductVariationDetails();
                                    }

                                    $feature_details->product_id = $data->id;
                                    $feature_details->attribute_id = $attribute_id;
                                    $feature_details->variation_id = $variation->id;
                                    $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                                    $feature_details->save();
                                }
                            }
                        } else {
                            //delete all unselected variation
                            ProductVariation::where('attribute_id', $attribute_id)->where('product_id', $product_id)->delete();
                            ProductVariationDetails::where('attribute_id', $attribute_id)->where('product_id', $product_id)->delete();
                        }
                    }
                }

                //insert or update product feature
                if ($request->features) {
                    try {
                        foreach ($request->features as $feature_id => $feature_name) {

                            $extraFeature = ProductFeature::where('product_id', $product_id)->where('feature_id', $feature_id)->first();
                            if (!$extraFeature) {
                                $extraFeature = new ProductFeature();
                            }
                            $extraFeature->product_id = $product_id;
                            $extraFeature->feature_id = $feature_id;
                            $extraFeature->name = $feature_name;
                            $extraFeature->value = ($request->featureValue[$feature_id]) ? $request->featureValue[$feature_id] : null;
                            $extraFeature->save();
                        }
                    } catch (Exception $exception) {
                    }
                }

                // gallery Image upload
                if ($request->hasFile('gallery_image')) {
                    $gallery_image = $request->file('gallery_image');
                    foreach ($gallery_image as $image_id => $image) {
                        $productImage = ProductImage::where('product_id', $product_id)->where('id', $image_id)->first();

                        if ($productImage) {
                            //delete image from folder
                            $image_path = public_path('upload/images/product/gallery/' . $productImage->image_path);
                            if (file_exists($image_path) && $productImage->image_path) {
                                unlink($image_path);
                            }
                        } else {
                            $productImage = new ProductImage();
                        }

                        $new_image_name = $this->uniqueImagePath('product_images', 'image_path', $request->title . '.' . $image->getClientOriginalExtension());

                        //Resize image
                        $img = Image::make($image->getRealPath())->orientate()->resize(670, 475, function ($constraint) {
                            $constraint->aspectRatio();
                        })->resizeCanvas(670, 475, 'center', false, 'e7edee');

                        if (config('siteSetting.watermark')) {
                            //Add water mark in image
                            $watermark = Image::make(public_path('upload/images/logo/' . config('siteSetting.watermark')));
                            $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
                            $watermarkSize = $img->width() / 2; //half of the image size (2 dele half)
                            $resizePercentage = 50; //0% less then an actual image (play with this value)
                            $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
                            // resize watermark width keep height auto
                            $watermark->resize(150, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            //insert resized watermark to image center aligned
                            $img->insert($watermark->opacity(50), 'bottom-right');
                            //watermark end
                        }
                        //save image
                        $img->save(public_path('upload/images/product/gallery/' . $new_image_name));

                        $productImage->product_id = $data->product_id;
                        $productImage->image_path = $new_image_name;
                        $productImage->title = $new_image_name;
                        $productImage->save();
                    }
                }
                Toastr::success('Post update success.');
                return redirect()->route('post.list')->with('success', 'Post update successfully. Your post under review.');
            } else {
                Toastr::error('Post update failed.!');
            }
        } else {
            Toastr::error('Post update failed.!');
        }
        return back();
    }

    // delete product
    public function delete(Request $request)
    {
        $product = Product::where('id', $request->product_id)->where('user_id', Auth::id())->first();
        if ($product) {

            $gallery_images = ProductImage::where('product_id',  $product->product_id)->get();
            foreach ($gallery_images as $gallery_image) {
                $image_path = public_path('upload/images/product/gallery/' . $gallery_image->image_path);
                if (file_exists($image_path) && $gallery_image->image_path) {
                    unlink($image_path);
                }

                $gallery_image->delete();
            }

            $output = [
                'status' => true,
                'msg' => 'Post deleted successful.'
            ];

            //force sotf delete
            if ($product->approved == null) {
                $image_path = public_path('upload/images/product/' . $product->feature_image);
                if (file_exists($image_path) && $product->feature_image) {
                    unlink($image_path);
                }
                ProductVariation::where('product_id',  $product->id)->delete();
                ProductVariationDetails::where('product_id',  $product->id)->delete();
                ProductFeature::where('product_id',  $product->id)->delete();

                $product->delete();
            } else {
                //delete reason
                $product->delete_reason = $request->reason . ':<br/>' . $request->reason_details;
                $product->save();
                $product->delete();
            }
            Toastr::success('Post deleted successful.');
        } else {
            Toastr::error('Post delete failed.');
        }
        return back();
    }


    public function categoryChange(Request $request, $post_id, $category)
    {
        $category = Category::where('id', $category)->where('status', 1)->first();
        $category_id = ($category) ? $category->parent_id : $request->category;
        $subcategory_id = ($category) ? $category->id : null;
        $post = Product::find($post_id);
        $post->category_id = $category_id;
        $post->subcategory_id = $subcategory_id;
        $post->save();

        return redirect()->route('post.create', [$post->product_id, $category->slug]);
    }

    public function locationChange(Request $request, $post_id, $location)
    {

        $post = Product::find($post_id);
        $city = City::where("id", $location)->first();
        $post->state_id = $city->state_id;
        $post->city_id = $city->id;
        $post->save();

        return back();
    }

    // delete product image
    public function productImageDelete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $image_path = public_path('upload/images/product/' . $product->feature_image);
            if (file_exists($image_path) && $product->feature_image) {
                unlink($image_path);
                unlink(public_path('upload/images/product/thumb/' . $product->feature_image));
            }
            $product->delete();
            $output = [
                'status' => true,
                'msg' => 'Product image deleted successfully.'
            ];
        } else {
            $output = [
                'status' => false,
                'msg' => 'Product image cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    // delete GalleryImage
    public function deleteGalleryImage($id)
    {
        $find = ProductImage::find($id);
        if ($find) {
            //delete image from folder
            $thumb_image_path = public_path('upload/images/product/gallery/thumb/' . $find->image_path);
            $image_path = public_path('upload/images/product/gallery/' . $find->image_path);
            if (file_exists($image_path) && $find->image_path) {
                unlink($image_path);
                unlink($thumb_image_path);
            }
            $find->delete();
            $output = [
                'status' => true,
                'msg' => 'Gallery image deleted successfully.'
            ];
        } else {
            $output = [
                'status' => false,
                'msg' => 'Gallery image cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    //generate order id
    public function generatePostId()
    {
        $user_id = Auth::id();
        $prefix = $user_id;
        $numberLen = 6 - strlen($prefix);
        $product_id = $prefix . substr(str_shuffle("0123456789"), -$numberLen);

        $check_path = Product::select("product_id")->where("post_type", "sell")->where("product_id", 'like', '%' . $product_id)->where("status", "!=", "not posted")->get();

        if (count($check_path) > 0) {
            //find id until not used.
            for ($i = 1; $i <= 99; $i++) {
                $new_product_id = $prefix . substr(str_shuffle("0123456789"), -$numberLen);
                if (!$check_path->contains("product_id", $new_product_id)) {
                    return $new_product_id;
                }
            }
        } else {
            return $product_id;
        }
        return $product_id;
    }
}
