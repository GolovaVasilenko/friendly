@extends('layouts.app')
@section('meta_title') {{ $item->m_title }} @endsection
@section('meta_description') {{ $item->m_description }} @endsection
@section('content')
    <div class="catalog-page-container">
        <div class="system-container">
            <header class="header-container">
                <div class="header-block-text">
                    <!--<h1>{{ $headerTitle }}</h1>-->
                </div>
                <div class="breadcrumb-container">
                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a>
                    / <a href="{{ route('site.exhibitions', ['cat' => $item->categories[0]->slug]) }}" >{{ $item->categories[0]->translate(app()->getLocale())->name }}</a>
                    / {{ $headerTitle }}
                </div>
            </header>
            <div class="filter-container">
                <div class="form-container">
                    <form id="form-filter" action="{{ route('site.exhibitions') }}">
                        <div class="gallery-filter">
                            <select name="cat" class="selection">
                                @php
                                    function makeSelectCategoryTree($categories, $level = 0)
                                    {
                                        $output = '';
                                        $separator = '';
                                        if($level) {
                                            for($i = 0; $i < $level; $i++) {
                                                $separator .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                                            }
                                        }
                                        foreach($categories as $cat) {
                                            $output .= '<option value="' . $cat->slug . '">' . $separator . $cat->name . '</option>';
                                            if(isset($cat->children)) {
                                                $level++;
                                                $output .= makeSelectCategoryTree($cat->children, $level);
                                            }
                                        }
                                        return $output;
                                    }
                                @endphp
                                <option value="0">{{ trans('site.select_category') }}</option>
                                {!! makeSelectCategoryTree($categories) !!}
                            </select>
                        </div>
                        <div class="gallery-filter">
                            <select name="cat" class="selection">
                                <option value="0">{{ trans('admin.direction') }} - {{ trans('admin.genres') }}</option>
                                @foreach($catDirection as $cd)
                                    <option value="{{ $cd->slug }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $cd->name }}</option>
                                @endforeach
                                <option value="0">{{ trans('admin.genres') }}</option>
                                @foreach($catGenres as $cg)
                                    <option value="{{ $cg->slug }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $cg->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="gallery-filter">
                            <select name="attr" class="selection select-attr-js">
                                <option value="0">{{ trans('site.key_word') }}</option>
                                @foreach($itemAttributes as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="gallery-filter">
                            <select name="value" class="selection select-value-js">
                                <option value="0"> --</option>
                            </select>
                        </div>
                        <div class="button-filter-box search-bt-block">
                            <button type="submit" class="search-bt">{{ trans('site.btn_search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="main-single-container">
                <div class="system-container">
                    <div class="work-single-root">
                        <div class="work-sinle-image">
                            <div class="img-bg">
                            <div id="lightgallery" class="work-single-img-box">
                                <a href="{{ $item->getFirstMediaUrl('works') }}" data-sub-html="<h4>{{ $item->name }}</h4><p>{!! $item->description !!}</p>">
                                    <img src="{{ $item->getFirstMediaUrl('works') }}" alt="{{ $item->name }}"/>
                                </a>
                            </div>
                            </div>
                        </div>
                        <div class="work-single-info">
                            <h2>{{ $item->name }}</h2>
                            @foreach($itemAttributes as $key => $attr)
                            <span><!--{{ $attr }}:--> {{  $item->$key }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                            <div class="work-description">
                                {!! $item->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            $('.select-attr-js').on('change', function() {
                let attr = $(this).val();
                if(attr === '0') return false;
                $.ajax({
                    type: "POST",
                    url: "{!! route('ajax.data.attr.value') !!}",
                    data: {'attribute': attr},
                    success: function(data) {
                        let output = '';
                        for(let i = 0; i < data.results.length; i++) {
                            output += '<option value="' + data.results[i] + '">' + data.results[i] + '</option>';
                        }
                        $('.select-value-js').html(output);
                    }
                });
            });
        });
    </script>
@endsection
