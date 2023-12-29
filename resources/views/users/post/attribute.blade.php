@foreach($attributes as $attribute)
    <div class="col-md-6 col-lg-6 p-1">
        <input type="hidden" name="attribute[{{$attribute->id}}]" value="{{$attribute->name}}">
    
        <div class="form-group">
            <label class="@if($attribute->is_required == 1) required @endif">{{$attribute->name}}</label>
            @if($attribute->display_type == 1)
                @if(count($attribute->get_attrValues)>0)
                <ul class="form-check-list">
                    @foreach($attribute->get_attrValues as $value)
                    <li>
                        <input name="attributeValue[{{$attribute->id}}][]" @if($attribute->is_required == 1) required @endif value="{{$value->id}}" type="checkbox" class="form-check" id="attributeValue{{$value->id}}">
                        <label for="attributeValue{{$value->id}}" class="form-check-text">{{$value->name}}</label>
                    </li>
                    @endforeach
                </ul>
                @endif
            @elseif($attribute->display_type == 3)
            @if(count($attribute->get_attrValues)>0)
                <ul class="form-check-list">
                    @foreach($attribute->get_attrValues as $value)
                    <li>
                        <input name="attributeValue[{{$attribute->id}}][]" @if($attribute->is_required == 1) required @endif value="{{$value->id}}" type="radio" class="form-check" id="attributeValue{{$value->id}}">
                        <label for="attributeValue{{$value->id}}" class="form-check-text">{{$value->name}}</label>
                    </li>
                    @endforeach
                </ul>
                @endif

            @else
            <select class="form-control select2" @if($attribute->is_required == 1) required @endif name="attributeValue[{{$attribute->id}}][]">
                @if($attribute->get_attrValues)
                    @if(count($attribute->get_attrValues)>0)
                        <option value="">Select one</option>
                        @foreach($attribute->get_attrValues as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    @else
                        <option value="">Value Not Found</option>
                    @endif
                @endif
            </select>
            @endif

        </div>
    </div>
    @endforeach