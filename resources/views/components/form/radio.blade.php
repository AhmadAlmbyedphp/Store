
@props([
    'name',
     'options', 
     'checked',
     'label'=>false
     ])
    @if ($label)
    <label for="exampleInputEmail1">{{$label}}</label> 
    @endif
@foreach ($options as $value => $text)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}"
            @if(old($name, $checked) == $value) checked @endif
            {{ $attributes->merge([
                'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
            ]) }}
        >
        <label class="form-check-label" for="{{ $name }}_{{ $value }}">
            {{ $text }}
        </label>
    </div>
@endforeach
