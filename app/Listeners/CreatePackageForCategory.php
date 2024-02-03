<?php

namespace App\Listeners;

use App\Events\CategoryCreated;
use App\Models\PackageValue;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Traits\CreateSlug;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatePackageForCategory
{
    use CreateSlug;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CategoryCreated  $event
     * @return void
     */
    public function handle(CategoryCreated $event)
    {
        try {
            DB::beginTransaction();
        $categoryId = $event->categoryId;
        $request = $event->request;

         // Save ProductAttributes
         $attributeNames = $request->attribute_name;
         $displayTypes = $request->display_type;
         $isRequiredValues = $request->is_required;
         $isFilter = $request->is_filter;
         $attributeValues = $request->attribute_value;
         $attributeStatus = $request->attribute_status;
 
         // Assuming all arrays have the same length
         $packageIds = $request->package_id;
         $durations = $request->duration;
         $prices = $request->price;
         $packageStatuses = $request->package_status;
 
         for ($i = 0; $i < count($packageIds); $i++) {
             $packageData = new PackageValue();
             $packageData->package_id = $packageIds[$i];
             $packageData->category_id = $categoryId;
             $packageData->ads = 1;
             $packageData->price = $prices[$i];
             $packageData->discount = $request->discount;
             $packageData->duration = $durations[$i];
             $packageData->details = $request->details;
             $packageData->position = 9999;
             $packageData->status = ($packageStatuses[$i] ?? null) == 'on' ? 1 : 0;
             $packageData->save();
         }
 
         // Assuming the arrays are of the same length
         for ($i = 0; $i < count($attributeNames); $i++) {
             $productAttributeData = new ProductAttribute();
             $productAttributeData->name = $attributeNames[$i];
             $productAttributeData->slug = $this->createSlug('product_attributes', $attributeNames[$i]);
             $productAttributeData->category_id = $categoryId;
             $productAttributeData->display_type = $displayTypes[$i];
             $productAttributeData->is_required = ($isRequiredValues[$i] ?? null) == 'on' ? 1 : null;
             $productAttributeData->is_filter = ($isFilter[$i] ?? null) == 'on' ? 1 : null;
             $productAttributeData->qty = ($request->qty ? 1 : null);
             $productAttributeData->price = ($request->price ? 1 : null);
             $productAttributeData->image = ($request->image ? 1 : null);
             $productAttributeData->color = ($request->color ? 1 : null);
             $productAttributeData->status = ($attributeStatus[$i] ?? null) == 'on' ? 1 : 0;
             $productAttributeData->created_by = Auth::guard('admin')->id();
             $productAttributeData->save();
 
             //Save ProductAttributeValues
             $attributeValueArray = explode(',', $attributeValues[$i]);
            
             foreach ($attributeValueArray as $value) {
                 $attributeValue = new ProductAttributeValue();
                 $attributeValue->name = $value;
                 // Set other attributes accordingly
                 $attributeValue->attribute_id = $productAttributeData->id;
                 $attributeValue->status = $productAttributeData->status;
                 $attributeValue->created_by = Auth::guard('admin')->id();
                 $attributeValue->save();
             }
         }

         DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception as needed
            // throw $e;
            return $e;
        }
    }
}
