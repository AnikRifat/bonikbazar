<input type="hidden" name="id" value="{{$customer->id}}">
<div class="form-group">
    <label>Status</label>
    <select required onchange="postStatus(this.value)" name="status" class="form-control">
        <option value="" >Select Status</option>
        
        @if($verify)
        <option value="verify" @if($customer->verify) selected @endif>Verify</option>
        <option value="reject" @if($customer->sellerVerify && $customer->sellerVerify->status == "reject") selected @endif>Reject</option>
        @else
        <option value="pending" @if($customer->status == 'pending') selected @endif >Pending</option>
        <option value="active" @if($customer->status == 'active') selected @endif>Active</option>
        <option value="deactive" @if($customer->status == 'deactive') selected @endif>Deactive</option>
       
        <option value="band" @if($customer->status == 'band') selected @endif>Band</option>
        @endif
    </select>
</div>


@if($verify)
<div class="form-group" id="bandReason">@if($customer->sellerVerify &&  $customer->sellerVerify->status == 'reject')<div class="form-group"><label>Reject reason</label><textarea name="reject_reason" class="form-control" placeholder="Write reject reason">{!! $customer->sellerVerify->reject_reason !!}</textarea></div>@endif</div>
@endif
<script type="text/javascript">
     
        function postStatus(status) {
            if(status == 'reject'){
                $('#bandReason').html(`<div class="form-group">
   
</div><div class="form-group"><label>Write reject issue</label><textarea name="reject_reason" class="form-control" placeholder="Write reject reason">@if($customer->sellerVerify){!! $customer->sellerVerify->reject_reason !!} @endif</textarea></div>`);
            }else{
                 $('#bandReason').html('');
            }

        }
</script>