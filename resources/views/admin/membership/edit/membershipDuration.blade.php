<input type="hidden" value="{{$data->id}}" name="id">


    <div class="col-md-4">
        <div class="form-group">
            <label for="name" class="required">Month Duration</label>
            <input name="duration" required placeholder="Example: 5" value="{{$data->duration}}" class="form-control" type="number">
        </div>
    </div> 

    <div class="col-md-4">
        <div class="form-group">
            <label for="name" class="required">Price</label>
            <input name="price" required placeholder="Example: {{ config('siteSetting.currency_symble') }}50 " value="{{$data->price}}" class="form-control" type="number">
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="form-group">
            <label for="name">Discount</label>
            <input name="discount" value="{{$data->discount}}" placeholder="Example: 10%" class="form-control" type="number">
        </div>
    </div> -->
    <!-- <div class="col-md-12">
        <div class="form-group">
            <label for="name">Package Details</label>
            <input name="details" id="name" value="{{$data->details}}"  placeholder="Write details" type="text" class="form-control">
        </div>
    </div> -->
</div>                               
<div class="col-md-12 mb-12">
    <div class="form-group">
        <label class="switch-box">Status</label>
       
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                    <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
      
    </div>
</div>

