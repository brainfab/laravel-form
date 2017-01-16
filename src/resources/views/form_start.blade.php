@php
/**
 * @var \Symfony\Component\Form\FormView $form
 */
$method = strtoupper($method);
if (in_array($method, ["GET", "POST"])) {
    $form_method = $method;
} else {
    $form_method = "POST";
}
@endphp

<form{{!empty($action) ? ' action="'.$action.'"' : ''}}{{!empty($name) ? ' name="'.$name.'"' : ''}} method="{{$form_method}}" {{!empty($multipart) ? 'enctype="multipart/form-data"' : ''}} @foreach($attr as $attrName => $attrValue) {{$attrName}}="{{$attrValue}}" @endforeach >
@if($form_method != $method)
    {{method_field($method)}}
@endif
{{csrf_field()}}