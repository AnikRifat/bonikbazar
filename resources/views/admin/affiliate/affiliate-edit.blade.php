<input type="hidden" name="id" value="{{ $affiliate->id }}">
<div class="row justify-content-md-center">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name"> Name</label>
            <input  name="name" id="name" value="{{ $affiliate->name }}" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="name"> Mobile</label>
            <input  name="mobile" id="mobile" value="{{ $affiliate->mobile }}" required="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="email"> Email</label>
            <input  name="email" id="email" value="{{ $affiliate->email }}" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="code"> Affiliate Code</label>
            <input name="code" id="code" value="{{$affiliate->code}}" type="text" class="form-control">
        </div>
    </div>
</div>