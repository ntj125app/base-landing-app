@extends('base-components.base')
@section('title', 'Welcome to ' . config('app.name'))

@section('body')
    @parent
    <router-view />
@endsection