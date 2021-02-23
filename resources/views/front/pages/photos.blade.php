@extends('layouts.app')
@section('meta_title') {{ $pageTitle ?? '' }} @endsection
@section('meta_description') {{ $pageTitle ?? '' }} @endsection
@section('content')
    <div class="catalog-page-container">
        <div class="system-container">
            <header class="header-container">
                <div class="header-block-text">
                    <h1>{{ $pageTitle }}</h1>
                </div>
                <div class="breadcrumb-container">
                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a> / {{ $pageTitle }}
                </div>
            </header>
        </div>
        <div class="page-photos-wrappers">
            <div class="system-container">
                <ul id="lightgallery" class="photos-items">
                    @foreach($photos as $photo)
                        <li class="photos-item" data-src="{{ $photo->getFullUrl() }}" data-sub-html="<h4>{{ $photo->title }}</h4><p>{{ $photo->description }}</p>">
                            <div class="img-bg">
                                <div class="image-box">
                                    <img src="{{ $photo->getFullUrl() }}" alt="{{ $photo->alt }}" />
                                    <div class="img-info">
                                        <h3>{{ $photo->title }}</h3>
                                        {{ $photo->description }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pagination-wrapper">
                    {{ $photos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
