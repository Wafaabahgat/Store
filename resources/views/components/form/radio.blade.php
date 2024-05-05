@props(['name', 'checked' => false, 'options'])


@foreach ($options as $value => $text)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}"
            @checked(old($name, $checked) == $value)
            {{ $attributes->class(['form-control-input', 'is-invalid' => $errors->has($name)]) }}>
        <label class="form-check-label">
            {{ $text }}
        </label>
    </div>
@endforeach
