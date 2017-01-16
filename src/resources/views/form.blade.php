{{form_start($form)}}
    @foreach($form as $child)
        {{form_row($child)}}
    @endforeach
{{form_end($form)}}