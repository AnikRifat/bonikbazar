@extends('layouts.frontend')
@section('title', 'Change Password | '. Config::get('siteSetting.site_name') )
@section('css')

@endsection
@section('content')
<!-- Main Container  -->
<div class="container bg-white mb-2  px-0">
	@include('users.inc.user_header')
    <div class="row">
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <div class="col-12 col-md-3">
            @include('users.inc.sidebar')
        </div>@endif
        <div class="col-12 col-md-9">
			
			<form action="{{route('user.change-password')}}" method="post" data-parsley-validate>
				@csrf
				<div class="row">
					
					<div class="col-sm-6">
						<fieldset>
							<legend>Change Your Password</legend>
							<div class="form-group ">
								<label for="input-password">Old Password</label>
								<input type="password" required class="form-control"  placeholder="Old Password" value="" name="old_password">
							</div>
							<div class="form-group ">
								<label for="input-password">New Password</label>
								<input type="password" required class="form-control" minlength="6" id="password" placeholder="New Password" value="" name="password">
							</div>
							<div class="form-group ">
								<label for="input-confirm">New Password Confirm</label>
								<input type="password" class="form-control" id="input-confirm"  data-parsley-equalto="#password" required="" placeholder="New Password Confirm" value="" name="password_confirmation">
							</div>
						</fieldset>
						<div class="buttons clearfix">
							<div class="pull-right">
								<input type="submit" class="btn btn-md btn-primary" value="Save Changes">
							</div>
						</div>
					</div>
				</div>
				
			</form>
		</div>
		<!--Middle Part End-->
		
	</div>
</div>
<!-- //Main Container -->
@endsection