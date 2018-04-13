@if(!is_null($list))
    {{ Form::select('tipo_evento', $list, null, ['class' => 'form-control']) }}
@endif