@extends('layouts.app')

@section('breadcrumbs') {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('main') }} @endsection

@section('content')
<div class="container">
    <h1> This is Home Page</h1>
    <p>Locale {{ App::getLocale() }}</p>
</div>
@endsection
