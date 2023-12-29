<aside style="display: none; background: #fff;padding-top: 10px; box-shadow: 0 2px 4px 0 rgb(0 0 0 / 25%);transform: scale(1.0);" class="user-sidebar content-aside right_column sidebar-offcanvas">
    <span id="close-sidebar" class="fa fa-times"></span>
    
        <div class="profileImageBox">
            <div class="dash-avatar">
                <a href="#"><img data-toggle="tooltip" data-original-title="Upoad Profile Image" src="{{ asset('upload/users') }}/{{(Auth::user()->photo) ? Auth::user()->photo : 'default.png'}}"></a>
            </div>
            
            <span  data-toggle="modal" data-target="#user_imageModal" style=" position: absolute;bottom: 12px;border: 1px solid #ccc;right: 95px;border-radius: 50%;padding: 0px 7px;background: #ccc;"><i class="fa fa-camera"></i></span>
        </div>
        <p style="text-align: center;"><strong>{{Auth::user()->name}}</strong></p>
    
    <div class="module-content custom-border ">
       @include('users.inc.sidebar')
    </div>
</aside>

<div class="modal fade" id="user_imageModal" style="z-index: 9999999;">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="border:none;">
              Update Profile Image
              <button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form action="{{route('changeProfileImage')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group"> 
                        <input data-default-file="{{ asset('upload/users/avatars/') }}/{{(Auth::user()->photo) ? Auth::user()->photo : 'default.png'}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif" required="" data-max-file-size="10M"  name="profileImage" id="input-file-events">
                        <p style="color: red;font-size: 12px;">Image Size: 150px*150px</p>
                    </div>
                    @if ($errors->has('profileImage'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('profileImage') }}
                        </span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Change Image</button>
                </div>
            </form>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="user_coverImageModal" style="z-index: 9999999;">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="border:none;">
              Update Cover Photo
              <button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form action="{{route('changeProfileImage')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group"> 
                        <input data-default-file="{{ asset('upload/users/avatars/') }}/{{(Auth::user()->cover_photo) ? Auth::user()->cover_photo : 'default.png'}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif" required="" data-max-file-size="10M"  name="cover_photo" id="input-file-events">
                        <p style="color: red;font-size: 12px;">Image Size: 940px*250px</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Change Photo</button>
                </div>
            </form>
          </div>
      </div>
    </div>
</div>
<!--user image Modal -->


