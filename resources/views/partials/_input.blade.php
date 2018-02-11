<div class="form-group row{{ $errors->has($key) ? ' has-error' : '' }}">
    <label class="col-form-label col-md-2" for="{{ $key }}">{{ $label }}</label>
    <div class="col-md-6">
        <input type="text" id="{{ $key }}" name="{{ $key }}" class="form-control" value="{{ old($key, $value) }}" />

        @if ($errors->has($key))
            <span class="help-block">
                <b>{{ $errors->first($key) }}</b>
            </span>
        @endif
    </div>
</div>
