@extends('layouts.app')
@section('meta_title') {{ $meta_title ?? '' }} @endsection
@section('meta_description') {{ $meta_description ?? '' }} @endsection
@section('styles')
<link href="{{ asset('styles/jquery.bxslider.css') }}" rel="stylesheet" />
@endsection

@section('slider')
    <div class="system-container">
        <div class="slider-block">
        <div class="slider">
            @foreach($slider as $slide)
            <div>
                <div class="item-slide">
                    <div class="image-info">
                        <div class="img-subtitle">{{ $slide->subtitle }}</div>
                        <div class="img-title"><h3><a href="{{ $slide->url ?? '#' }}">{{ $slide->title }}</a></h3></div>
                    </div>
                    <div class="image-box">
                        <a href="{{ $slide->url ?? '#' }}">
                        <img src="{{ $slide->getFirstMediaUrl('sliders') }}" alt="{{ $slide->title }}"/>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
@section('content')
    <div class="system-container">
        <div class="about-author">
            <div class="author-block-container">
                @php $block1 = $blocks[0] @endphp
                <div class="author-img-block">
                    <img src="{{ $block1->getFirstMediaUrl('blocks') }}" alt=""/>
                </div>
                <h2 class="header-block-text">{{ $block1->title }}</h2>
                <div class="bg-block-container bg-lite" >
                    <div class="author-history">
                       {!! $block1->text !!}
                    </div>
                    <div class="bt-rm">
                        <div class="bt-rm-square-1">
                            <a href="{{ route('site.page.static', ['page' => 'biografia']) }}">
                            <img src="{{ asset('img/arrow-1.png') }}" class="bt-rm-arrow">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div id="gallery" class="gallery-section">
        <div class="system-container">
            <div class="header-box">
                <h2>{{ trans('site.gallery') }}</h2>
            </div>
            <div class="gallery-wrapper-row">
                <div class="gallery-menu-cat">
                    <ul>
                        @foreach($catalogList as $ci)
                        <li><a href="{{ route('site.exhibitions', ['cat' => $ci->slug]) }}">{{ $ci->name }}</a></li>
                            @php
                                $cat[$loop->index]['name'] = $ci->name;
                                $cat[$loop->index]['slug'] = $ci->slug;
                            @endphp
                        @endforeach
                    </ul>
                    <div class="bt-rm">
                        <div class="bt-rm-square-2">
                            <a href="{{ route('site.exhibitions') }}">
                                <img src="{{ asset('img/arrow-2.png') }}" class="bt-rm-arrow">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="gallery-items-block">
                    <div id="grid">
                        @foreach($catalogList as $img)
                        <div class="grid-item">
                            <a href="{{ route('site.exhibitions', ['cat' => $cat[$loop->index]['slug']]) }}">
                                <img src="{{ $img->img }}" alt="{{ $cat[$loop->index]['name'] }}" />
                                <div class="owerlay-item">
                                    <div class="owerlay-item-content">
                                        {{ $cat[$loop->index]['name'] }}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="system-container">
        <div id="posts-section">
            <div class="items-posts-wrapper">
                <div class="header-box-light">
                    <h2>{{ trans('site.publications') }}</h2>
                </div>
                <div class="items-post-content">
                    @foreach($posts as $post)
                    <div class="item-content-wrapp">
                        <div class="item-post-img-box">
                            <img src="{{ $post->getFirstMediaUrl('images') }}" alt="{{ $post->title }}" width="470">
                            <div class="bt-rm">
                                <div class="bt-rm-square-1">
                                    <a href="{{ route('site.blog.single', ['slug' => $post->slug]) }}">
                                        <img src="{{ asset('img/arrow-1.png') }}" class="bt-rm-arrow">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item-post-info">
                            <h3><a href="{{ route('site.blog.single', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                            <div class="excerpt">
                                {!! $post->intro !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>-->
    <div id="video-section">
        @php $block2 = $blocks[1] ?? null @endphp
        <div class="system-container">
            <div class="header-box">
                <h2>{{ $block2->title }}</h2>
            </div>
            <div class="video-content-container">
                <div id="youtubePlayer" class="video-box" style="background-image:url('images/video-player-thumb.png');">
                    <a href="{{ $block2->link }}" data-poster="{{ asset('images/video-player-thumb.png') }}">
                        <div class="video">
                            <span class="btn-youtube"></span>
                        </div>
                    </a>
                </div>
                <div class="video-info">
                    {!! $block2->text !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('styles/bxslider/jquery.bxslider.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.slider').bxSlider({
                auto: true,
                pause: 6000,
                speed: 800,
                pager: false
            });

        });
    </script>
@endsection
