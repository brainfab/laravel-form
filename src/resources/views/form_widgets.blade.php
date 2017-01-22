@block('widget_attributes')
    id="{{ $id or '' }}" name="{{ $full_name or '' }}"
    @if($disabled) disabled="disabled" @endif
    @if($required) required="required" @endif
    @foreach($attr as $attrname => $attrvalue)
        {{' '}}
        @if(in_array($attrname, ['placeholder', 'title']))
        {{$attrname}}="{{$attrvalue}}"
        @elseif($attrvalue === true)
        {{$attrname}}="{{$attrname}}"
        @elseif($attrvalue !== false)
        {{$attrname}}="{{$attrvalue}}"
        @endif
    @endforeach
@endblock

@block('widget_container_attributes')
    id="{{ $id or '' }}"
    @if($disabled) disabled="disabled" @endif
    @if($required) required="required" @endif
    @foreach($attr as $attrname => $attrvalue)
        {{' '}}
        @if(in_array($attrname, ['placeholder', 'title']))
        {{$attrname}}="{{$attrvalue}}"
        @elseif($attrvalue === true)
        {{$attrname}}="{{$attrname}}"
        @elseif($attrvalue !== false)
        {{$attrname}}="{{$attrvalue}}"
        @endif
    @endforeach
@endblock

@block('button_attributes')
    id="{{ $id or '' }}" name="{{ $full_name or '' }}" @if($disabled) disabled="disabled" @endif
    @foreach($attr as $attrname => $attrvalue)
        {{' '}}
        @if(in_array($attrname, ['placeholder', 'title']))
        {{$attrname}}="{{$attrvalue}}"
        @elseif($attrvalue === true)
        {{$attrname}}="{{$attrname}}"
        @elseif($attrvalue !== false)
        {{$attrname}}="{{$attrvalue}}"
        @endif
    @endforeach
@endblock



@block('datetime_widget')
    @if($widget == 'single_text')
        @yieldblock('form_widget_simple')
    @else
        <div @yieldblock('widget_container_attributes')>
            {{form_errors($form['date'])}}
            {{form_errors($form['time'])}}
            {{form_widget($form['date'])}}
            {{form_widget($form['time'])}}
        </div>
    @endif
@endblock

@block('date_widget')
    @if($widget == 'single_text')
        @yieldblock('form_widget_simple')
    @else
        @php
            $vars = $widget == 'text' ? ['attr' => ['size' => 1]] : [];
        @endphp

        <div @yieldblock('widget_container_attributes')>
            {{form_widget($form['hour'], $vars)}}@if($with_minutes):{{form_widget($form['minute'], $vars)}}@endif@if($with_seconds):{{form_widget($form['second'], $vars)}}@endif
        </div>
    @endif
@endblock

@block('number_widget')
    @php
        $type = isset($type) && $type ? $type : 'text';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('integer_widget')
    @php
        $type = isset($type) && $type ? $type : 'number';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('url_widget')
    @php
        $type = isset($type) && $type ? $type : 'url';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('search_widget')
    @php
        $type = isset($type) && $type ? $type : 'search';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('percent_widget')
    @php
        $type = isset($type) && $type ? $type : 'text';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('password_widget')
    @php
        $type = isset($type) && $type ? $type : 'password';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('hidden_widget')
    @php
        $type = isset($type) && $type ? $type : 'hidden';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('email_widget')
    @php
        $type = isset($type) && $type ? $type : 'email';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('range_widget')
    @php
        $type = isset($type) && $type ? $type : 'range';
    @endphp
    @yieldblock('form_widget_simple')
@endblock

@block('button_widget')
@endblock

@block('submit_widget')
@endblock

@block('reset_widget')
@endblock

@if ($widget == 'checkbox')
    <input type="checkbox" @yieldblock('widget_attributes') @if(isset($value)) value="{{$value}}" @endif
    @if($checked) checked="checked" @endif name="{{$name or ''}}">
@endif

@if ($widget == 'radio')
    <input type="radio" @yieldblock('widget_attributes') @if(isset($value)) value="{{$value}}" @endif
    @if($checked) checked="checked" @endif name="{{$name or ''}}">
@endif

@if ($widget == 'text')
    <input type="text" value="{{$value or ''}}" name="{{$name or ''}}">
@endif

@if ($widget == 'textarea')
    <textarea @yieldblock('widget_attributes')>{{ $value or '' }}</textarea>
@endif

@if ($widget == 'submit')
    <button type="submit">{{$label}}</button>
@endif