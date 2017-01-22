{{--Widgets--}}

@block('form_widget')
    @if($compound)
        @yieldblock('form_widget_compound')
    @else
        @yieldblock('form_widget_simple')
    @endif
@endblock

@block('form_widget_simple')
    @php
        $type = isset($type) ? $type : 'text';
    @endphp
    <input type="{{$type}}" @yieldblock('widget_attributes') @if(!empty($value)) value="{{$value}}" @endif />
@endblock

@block('form_widget_compound')
<div @yieldblock('widget_container_attributes')>
    @if(empty($form['parent']))
        {{ form_errors($form) }}
    @endif

    @yieldblock('form_rows')

    {{ form_rest($form) }}
</div>
@endblock