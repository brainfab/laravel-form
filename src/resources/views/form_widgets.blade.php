@if ($widget == 'text')
    <input type="text" value="{{$value or ''}}" name="{{$name or ''}}">
@endif

@if ($widget == 'email')
    <input type="email" value="{{$value or ''}}" name="{{$name or ''}}">
@endif

@if ($widget == 'submit')
    <button type="submit">{{$label}}</button>
@endif