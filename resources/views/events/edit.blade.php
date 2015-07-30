@extends('admin')

@section('content')

<h1 class="page-header">{{ 'Edit Event' }}</h1>

{!! Form::model($event, ['method' => 'PATCH', 'route' => ['events.update', $event->id]]) !!}
    @include ('events.__form', ['submitButtonText' => 'Edit'])
{!! Form::close() !!}
@stop