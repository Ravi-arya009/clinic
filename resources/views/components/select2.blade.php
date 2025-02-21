@props([
    'name',
    'options' => [],
    'selected',  // Now we just accept the value directly
    'valueKey' => 'id',
    'labelKey' => 'name'
])

<select class="form-control select2_dropdown" name="{{ $name }}" id="{{ $name }}">
    <option value="" selected>Select</option>
    @foreach ($options as $option)
        <option
            value="{{ $option->$valueKey }}"
            @if (old($name, $selected ?? '') == $option->$valueKey) selected @endif
        >
            {{ $option->$labelKey }}
        </option>
    @endforeach
</select>
