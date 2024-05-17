<ul class="list-box" style="border-right: 1px solid #ccc;">
    <li ><a href="{{route('user.dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
    <li ><a href="{{route('post.create')}}"><i class="fa fa-pencil-alt"></i> Ads Post</a></li>
    <li class="navbar-dropdown" style="">
        <a class="navbar-link" href="javascript:void(0)">
            <span><i style="font-size: 16px;" class="fa fa-th-list"></i> My Ads</span>
            <i class="fas fa-plus"></i>
        </a>
        <ul class="dropdown-list" style="display: none;">
            <li><a href="{{route('post.list')}}">All Ads</a></li>
            <li><a href="{{route('post.list', 'active')}}">Active Ads</a></li>
            <li><a href="{{route('post.list', 'deactive')}}">Deactive Ads</a></li>
            <li><a href="{{route('post.list', 'reject')}}">Reject Ads</a></li>
            <li><a href="{{route('post.list', 'pending')}}">Pending Ads</a></li>
        </ul>
    </li>
    <li ><a href="{{route('linkAds')}}"><i class="fa fa-ad"></i> Link Ads</a></li>
    <li ><a href="{{route('user.packageHistory')}}"><i class="fa fa-clipboard-list"></i> My Package</a></li>
    <li ><a href="{{route('user.message')}}"><i class="fa fa-comment"></i> Message</a></li>
    <li ><a href="{{route('allNotifications')}}"><i class="fa fa-bell"></i> Notifications</a></li>
    <li ><a href="{{route('wishlists')}}"><i class="fa fa-heart"></i> Wishlist</a></li>
    <li ><a href="{{route('user.profile')}}"><i class="fa fa-user"></i> My Profile</a></li>
    <li ><a href="{{route('verifyAccount')}}"><i class="fa fa-user-plus"></i> Seller Verification</a></li>
    @if(Auth::user()->sellerVerify)
    <li ><a href="{{route('membershipPlan')}}"><i class="fa fa-tags"></i> Membership Plan</a></li>@endif
    <li ><a href="{{route('user.change-password')}}"><i class="fa fa-edit"></i> Change Password </a></li>
    <li><a onclick="handleLogout(event)"><i class="fa fa-power-off"></i> Logout</a></li>
    <!-- <li><button onclick="handleLogout()"><i class="fa fa-power-off"></i> Logout</button></li> -->
</ul>

<script>
function handleLogout(event) {
    console.log("sidebar");
    event.preventDefault();
    sessionStorage.removeItem('fcmStarted');
    messaging.requestPermission()
            .then(function () {
                return messaging.getToken();
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("remove.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        sessionStorage.removeItem('fcmStarted');
                        console.log("res from here: ", response);
                        location.reload();
                    },
                    error: function (error) {
                        console.log("Error storing FCM token:", error);
                    }
                });
            })
            .catch(function (error) {
                console.log("Error getting permission:", error);
            });
}
</script>