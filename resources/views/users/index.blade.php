@extends('admin')

@section('title')
    User index
@stop

@section('header')
    @include('shared.datagrid', ['table_id_list_string' => 'users_table'])
@stop

@section('content')
	@include('users.table', ['from' => 'users'])
@stop