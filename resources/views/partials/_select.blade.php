<div class="form-group row{{ $errors->has($key) ? ' has-error' : '' }}">
    <label class="col-form-label col-md-2" for="{{ $key }}">{{ $label }}</label>
    <div class="col-md-6">
        <select id="{{ $key }}" name="{{ $key }}" class="form-control" >
            @foreach($options as $option => $description)
                @if ($option == old($key, $value))
                <option value="{{ $option }}" selected="selected">
                @else
                <option value="{{ $option }}">
                @endif
                    {{ $description }}
                </option>
            @endforeach
        </select>

        @if ($errors->has($key))
            <span class="help-block">
                <b>{{ $errors->first($key) }}</b>
            </span>
        @endif
    </div>
</div>
