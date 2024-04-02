@extends('base-components.base')
@section('title', $pageTitle)

@section('body')
    @parent
    <router-view
    app-name="{{ config('app.name') }}"
    greetings="{{ Auth::user()?->name }}"
    expanded-keys-props="{{ $expandedKeys ?? '' }}"
    ></router-view>
@endsection