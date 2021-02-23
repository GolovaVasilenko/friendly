@extends('layouts.app')
@section('meta_title') {{ $page->meta_title ?? '' }} @endsection
@section('meta_description') {{ $page->meta_description ?? '' }} @endsection
@section('content')
    <div class="catalog-page-container">
        <div class="system-container">
            <header class="header-container">
                <div class="header-block-text">
                    <h1>{{ $page->title }}</h1>
                </div>
                <div class="breadcrumb-container">
                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a> / {{ $page->title }}
                </div>
            </header>
        </div>
        <div class="page-main-content">
            <div class="system-container">
                {!! $page->body !!}
            </div>
        </div>
    </div>
@endsection
