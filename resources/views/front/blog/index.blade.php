@extends('layouts.app')
@section('meta_title') {{ $headerTitle }} @endsection
@section('meta_description') {{ $headerTitle }} @endsection
@section('content')
    <div class="catalog-page-container">
        <div class="system-container">
            <header class="header-container">
                <div class="header-block-text">
                    <h1>{{ $headerTitle }}</h1>
                </div>
                <div class="breadcrumb-container">
                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a> / {{ $headerTitle }}
                </div>
            </header>
        </div>

        <div class="blog-main-container">
            <div class="posts-items">
                @foreach($posts as $post)
                    @if($loop->first) <div class="post-items-row"> @endif
                    <div class="post-item">
                        <div class="image-wrapp">
                            <div class="post-image">
                                <img src="{{ $post->getFirstMediaUrl('images') }}" alt="{{ $post->title }}"/>
                            </div>
                            <div class="bt-rm">
                                <div class="bt-rm-square-1">
                                    <a href="{{ route('site.blog.single', ['slug' => $post->slug]) }}">
                                        <img src="{{ asset('/img/arrow-1.png') }}" class="bt-rm-arrow">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="post-info">
                            <h3><a href="{{ route('site.blog.single', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                            <div class="post-intro">
                                {!! $post->intro !!}
                            </div>
                        </div>
                    </div>
                    @if($loop->iteration % 2 == 0 && !$loop->last) </div><div class="post-items-row">@endif
                    @if($loop->last) </div> @endif
                @endforeach
            </div>
        </div>
        <div class="pagination-wrapper">
            @IF($posts)
            {{ $posts->links() }}
            @ENDIF
        </div>

    </div>
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function() {
        /*let itemsRow = $('.post-items-row');
        let iterator = 1;
        for(let i = 0; i < itemsRow.length; i++) {
            if(iterator % 2 == 0) {
                $(itemsRow[i]).addClass('right-site');
            }
            iterator += 1;
        }*/
    });
</script>
@endsection
