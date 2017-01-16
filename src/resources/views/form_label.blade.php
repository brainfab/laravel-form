@if(isset($label) && false !== $label)
    @php

    if (isset($clicked)) {
        return;
    }

    if (!isset($compound) || !$compound) {
        $label_attr = array_merge($label_attr, ['for' => $id]);
    }

    if ($required) {
        $label_class = !empty($label_attr['class']) ? $label_attr['class'] : '';
        $label_attr = array_merge($label_attr, ['class' => trim($label_class.' required')]);
    }

    if (empty($label)) {
        if (!empty($label_format)) {
            $label = str_replace(['%name%', '%id%'], [$name, $id], $label_format);
        } else {
            $label = title_case($name);
        }
    }
    @endphp

    <label @foreach($label_attr as $attrname => $attrvalue) {{ $attrname }}="{{ $attrvalue }}" @endforeach >{{ $label }}</label>
@endif