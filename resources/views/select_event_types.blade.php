@if(!is_null($list))
    {{ Form::select('tipo_evento', $list, $event_type, ['class' => 'form-control'] + $attribs+ ['onfocus' => 'hideError(\'tipo_evento\')'])}}
@endif