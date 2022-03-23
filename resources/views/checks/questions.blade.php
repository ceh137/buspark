@extends('layouts.app')

@section('content')


<div id="app">
        <test :user="{{auth()->user()->id}}">
</div>


@endsection
