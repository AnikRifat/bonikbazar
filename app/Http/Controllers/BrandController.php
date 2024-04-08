<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Category;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    use CreateSlug;

    public function index()
    {
        $data['permission'] = $this->checkPermission('product-brand');
        if (!$data['permission'] || !$data['permission']['is_view']) {
            return back();
        }

        $data['get_category'] = Category::where('parent_id', '=', null)->orderBy('position', 'asc')->get();

        $data['get_data'] = Brand::orderBy('position', 'asc')->paginate(25);
        return view('admin.brand')->with($data);
    }
    // store brand
    public function store(Request $request)
    {

        $permission = $this->checkPermission('product-brand', 'is_add');
        if (!$permission) {
            Toastr::error(env('PERMISSION_MSG'));
            return back();
        }

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $data = new Brand();
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->slug = $this->createSlug('brands', $request->name);
        $data->status = ($request->status ? 1 : 0);

        if ($request->hasFile('phato')) {
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/brand/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(120, 120);
            $image_resize->save($image_path);
            $data->logo = $new_image_name;
        }

        $store = $data->save();
        if ($store) {
            Toastr::success('Brand Create Successfully.');
        } else {
            Toastr::error('Brand Cannot Create.!');
        }

        return back();
    }

    //edit brand
    public function edit($id)
    {

        $data['permission'] = $this->checkPermission('product-brand', 'is_edit');
        if (!$data['permission']) {
            return env('PERMISSION_MSG');
        }
        $data['get_category'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->get();
        $data['data'] = Brand::find($id);
        echo view('admin.edit.brand')->with($data);
    }

    //update brand
    public function update(Request $request, Brand $brand)
    {

        $data['permission'] = $this->checkPermission('product-brand', 'is_edit');
        if (!$data['permission']) {
            Toastr::error(env('PERMISSION_MSG'));
            return back();
        }

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $data = Brand::find($request->id);
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->status = ($request->status ? 1 : 0);

        if ($request->hasFile('phato')) {
            //delete image from folder
            $image_path = public_path('upload/images/brand/thumb/' . $data->logo);
            if (file_exists($image_path) && $data->logo) {
                unlink($image_path);
                //                unlink(public_path('upload/images/brand/'. $data->logo));
            }
            $image = $request->file('phato');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();

            $image_path = public_path('upload/images/brand/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(120, 120);
            $image_resize->save($image_path);

            //            $image->move(public_path('upload/images/brand'), $new_image_name);

            $data->logo = $new_image_name;
        }

        $store = $data->save();
        if ($store) {
            Toastr::success('Brand Update Successfully.');
        } else {
            Toastr::error('Brand Cannot Update.!');
        }

        return back();
    }


    public function delete($id)
    {
        //check role permission
        $permission = $this->checkPermission('product-brand', 'is_delete');
        if (!$permission) {
            return response()->json([
                'status' => false,
                'msg' => env("PERMISSION_MSG")
            ]);
        }
        $delete = Brand::where('id', $id)->first();

        if ($delete) {
            $image_path = public_path('upload/images/brand/thumb/' . $delete->logo);
            if (file_exists($image_path) && $delete->logo) {
                unlink($image_path);
                //                unlink(public_path('upload/images/brand/'. $delete->logo));
            }
            $delete->delete();

            $output = [
                'status' => true,
                'msg' => 'Brand deleted successfully.'
            ];
        } else {
            $output = [
                'status' => false,
                'msg' => 'Brand cannot deleted.'
            ];
        }
        return response()->json($output);
    }



    public function brandmodel_store(Request $request)
    {

         // Validate the request data
         $request->validate([
            'model_name' => 'required|array', // Ensure model_name is an array
            'model_name.*' => 'string', // Ensure each item in model_name is a string
        ]);

        // Initialize $store variable to keep track of the success of the database operation
        $store = false;

        // Loop through each model_name provided in the request
        foreach ($request->model_name as $modelName) {
            // Split the string by comma and trim whitespace from each item
            $modelNames = array_map('trim', explode(',', $modelName));

            // Loop through each item after splitting by comma
            foreach ($modelNames as $name) {
                // Create a new BrandModel instance
                $data = new BrandModel();
                $data->name = $name;
                $data->brand_id = $request->brand_id;
                $data->status = $request->has('status') ? 1 : 0; // Check if status key is present in request
                $data->created_by = Auth::guard('admin')->id();

                // Save the BrandModel instance
                $store = $data->save();
            }
        }

        // Check if data was successfully stored in the database
        if ($store) {
            Toastr::success('Model(s) created successfully.');
        } else {
            Toastr::error('Model(s) could not be created.');
        }

        // Redirect back to the previous page
        return back();
    }


    public function brandmodel($slug)
    {
        $data['brand'] = Brand::where('slug', $slug)->first();
        if ($data['brand']) {
            $data['get_data'] = BrandModel::where('brand_id', $data['brand']->id)->get();
        } else {
            Toastr::error('Attribute not found.!');
            return back();
        }

        // return $data;
        return view('admin.brand.brand_model')->with($data);
    }


    public function brandmodel_edit($id)
    {
        $data['data'] = BrandModel::find($id);
        echo view('admin.category.edit.product-attributevalue')->with($data);
    }


    public function brandmodel_update(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required'
        ]);
        $data = BrandModel::find($request->id);
        $data->name = $request->name;
        $data->status = ($request->status ? 1 : 0);
        $data->updated_by =  Auth::guard('admin')->id();
        $store = $data->save();
        if ($store) {
            Toastr::success('Model update successfully.');
        } else {
            Toastr::error('Model cannot update.!');
        }

        return back();
    }

    public function brandmodel_delete($id)
    {
        $delete = BrandModel::where('id', $id)->delete();

        if ($delete) {
            $output = [
                'status' => true,
                'msg' => 'Model deleted successful.'
            ];
        } else {
            $output = [
                'status' => false,
                'msg' => 'Model delete failed.'
            ];
        }
        return response()->json($output);
    }
}
