@extends('admin')

@section('title')
    Ticker index
@stop

@section('header')
    @include('shared.datagrid', ['table_id_list_string' => 'tickers_table'])
@stop

@section('content')
    @include('tickers.table', ['from' => 'tickers'])
@stop