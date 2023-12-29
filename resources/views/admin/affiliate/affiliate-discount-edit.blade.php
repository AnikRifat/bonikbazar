<input type="hidden" name="id" value="{{ $affiliate->id }}">
<div class="col-md-12">
    <div class="form-group">
        <label for="name">Membership</label>
        <select required name="membership" class="form-control">
            <option value="all">All membership</option>
            @foreach($memberships as $membership)
            <option @if($affiliate->membership == $membership->slug) selected @endif value="{{$membership->slug}}">{{$membership->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="name">Month</label>
        <select name="month" required class="form-control">
            <option value="">Select Month</option>
            @for($i=1; $i<=12; $i++)
            <option @if($affiliate->month == $i) selected @endif value="{{$i}}">{{$i}} Month</option>
            @endfor
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="discount"> Discount(%)</label>
        <input  name="discount" required placeholder="Enter discount" id="discount" value="{{ $affiliate->discount }}" type="number" class="form-control">
    </div>
</div>