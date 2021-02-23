@extends('layouts.app')
@section('meta_title') {{ $post->meta_title }} @endsection
@section('meta_description') {{ $post->meta_description }} @endsection
@section('content')
    <div class="catalog-page-container">
        <div class="system-container">
            <header class="header-container">
                <div class="header-block-text">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="breadcrumb-container">

                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a>
                    / <a href="{{ route('site.blog',[ 'rubric' => $post->rubrics[0]->slug ]) }}">{{ $post->rubrics[0]->translate(app()->getLocale())->title }}</a>
                    / {{ $post->title }}
                </div>
            </header>
        </div>

        <div class="single-post-container">
            <div class="system-single-container">
                <div class="single-post-content">
                    <div class="single-post-body">
                        <div class="image-wrapper-single">
                        <img src="{{ $post->getFirstMediaUrl('images') }}" alt="{{ $post->title }}" />
                        </div>
                            {!! $post->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
