@include('shared.alert')

{!! Form::hidden('client_id', $client->id) !!}

<div class="form-group">
    {!! Form::label('name', trans('messages.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('name') }}</small>
</div>

<div class="form-group">
    {!! Form::label('ip_address', trans('messages.ip_address')) !!}
    {!! Form::text('ip_address', null, ['class' => 'form-control', 'placeholder' => 'x.x.x.x']) !!}
    <small class="text-danger">{{ $errors->first('ip_address') }}</small>
</div>

<div class="form-group">
    {!! Form::label('screen_group_id', trans_choice('messages.screen_group',1)) !!}
    {!! Form::select('screen_group_id', $screenGroups, $client->screen_group_id, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('screen_group_id') }}</small>
</div>
<div class="btn-group pull-right">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
</div>