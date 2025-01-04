
@props([
    'name',
    'options' => [],
    'label' => null,
    'selected' => null
])

@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<select
    name="{{ $name }}"
    {{ $attributes->class([
        'form-control',
        'form_select',
        'is-invalid' => $errors->has($name)
    ]) }}>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}"
            {{ $value == old($name, $selected) ? 'selected' : '' }}>
            {{ $text }}
        </option>
    @endforeach
</select>

<!-- عرض رسالة الخطأ إن وجدت -->
<x-form.validation-feedback :name="$name" />

