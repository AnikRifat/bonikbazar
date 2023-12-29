<form  onsubmit="return confirm('Are you sure update this ad payment info.?')" action="{{route('addvertisement.changeAdPaymentStatus')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
        	<input type="hidden" name="id" value="{{ $addvertisement->id }}">
            <table class="">
                <tr><td style="font-weight: bold;">Customer Name:</td><td> {{ $addvertisement->customer->name }}</td></tr>
                <tr><td style="font-weight: bold;">Payble Amount:</td><td>  {{$addvertisement->amount   }}</td>
                </tr>
            </table>
      
            <span style="font-weight: bold;">Payment Information:</span><br/>
            @if($addvertisement->tnx_id) Trnx Id: {{$addvertisement->tnx_id}} <br> @endif {{ $addvertisement->payment_info}}
            
        </div>

        <div class="col-md-12">
            <label for="notes">Payment Status</label>
            <select name="payment_status" required="" class="form-control" id="status">
                <option value="">Select Status</option>
                <option @if($addvertisement->payment_status== 'pending') selected @endif value="pending">Pending</option>
                <option @if($addvertisement->payment_status== 'paid') selected @endif value="paid">Paid</option> 
            </select>
        </div>

        <div class="col-md-12">
            <div class="modal-footer">
                <button type="submit" id="submitBtn" class="btn btn-success"> <i class="fa fa-save"></i> Update payment</button>
            </div>
        </div>
       
    </div>
</form>