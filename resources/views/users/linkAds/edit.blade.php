<input type="hidden" value="{{$data->id}}" name="id">
<div class="row">
    <div class="col-12">
       
        <label class="mb-2" for="">Type your banner link</label>
        <input type="text" required name="redirect_url" value="{{ $data->redirect_url }}" placeholder="link" class="mb-2 w-100 borders p-2 gb shadow-b rounded-3">
      
    </div> 
        
    <div class="col-12">
        <div class="form-group">
        <label for="">Select Your Banner For Desktop</label>
        <select name="desktopAd_position"  required="required" id="position" class="form-control borders p-2 gb shadow-b rounded-3">
        <option value="" selected disabled>Select an option</option>
            <option value="top" @if($data->position == "top") selected @endif>Banner for desktop (Top view)</option>
            <option value="bottom" @if($data->position == "bottom") selected @endif>Banner for desktop (Bottom view)</option>
        </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
        <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*" data-max-file-size="15M" data-default-file="{{asset('upload/marketing/'.$data->image)}}" data-max-width="960" data-max-height="250" class=" dropify shadow-b" name="desktop_image">
        <span>Size: 960 * 250 px</span></div>
    </div>
   
    <div class="col-12 col-md-6">
        <label class="my-2 w-100" for="">Select Your Banner For Desktop (SideView)</label>
        <select name="sideAd_position" class="form-control mb-2 gb shadow-b borders" id="desktop_sideAds">
            <option value="" selected disabled>Select an option</option>
            <option data-width="240" data-height="600" value="leftSide" @if($data->sideAd_position == "leftSide") selected @endif>Left Sidebar</option>
            <option data-width="160" data-height="600" value="rightSide" @if($data->sideAd_position == "rightSide") selected @endif>Right Sidebar</option>
        </select>
        <div class="h-500">
            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*" data-max-file-size="15M" data-default-file="{{asset('upload/marketing/'.$data->sideAd_image)}}" class=" dropify mt-2 shadow-b" data-max-width="240" data-max-height="600" name="sideAd_image">
            <span id="sideAdSize">Size: 240*600 px</span>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <label class="mb-2 w-100" for="">Select Your Banner For Mobile</label>
        <div>
            <input type="file" data-allowed-file-extensions="jpg jpeg png gif" accept="image/*" data-max-file-size="5M" data-default-file="{{asset('upload/marketing/'.$data->mobile_image)}}" class=" dropify mt-2 shadow-b" data-max-width="300" data-max-height="300" name="mobile_image">
            <span>Size: 300*300 px</span>
        </div>
    </div>
</div>