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
                <h1>{{ trans('site.title_search')  }} {{ count($results) }}</h1>
                <div class="results-items">
                    @empty($results)
                        <h3>{{ trans('site.not_found') }}</h3>
                    @else
                        @foreach($results as $item)
                            <div class="result-item">

                                @isset($item->title)
                                    <h3>{{ $item->title }}</h3>
                                @endisset
                                @isset($item->name)
                                    <h3>
                                        @if($item->image)
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" width="80px" />
                                        @endif
                                        <a href="{{ route('site.exhibitions.item', ['slug' => $item->slug]) }}">{{ $item->name }}
                                    </h3>
                                @endisset
                                @isset($item->description)
                                    {!! $item->description !!}
                                @endisset
                                    @isset($item->body)
                                        {!! $item->body !!}
                                    @endisset
                            </div>
                        @endforeach
                    @endempty

                </div>
            </div>
        </div>
    </div>


@endsection
