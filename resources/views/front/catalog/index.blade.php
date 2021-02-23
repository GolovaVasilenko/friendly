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
                    <a href="{{ route('main') }}">{{ trans('site.home') }}</a>
                    @if($category)
                        / <a href="{{ route('site.exhibitions') }}">{{ trans('admin.catalog') }}</a>
                    @endif
                    / {{ $headerTitle }}
                </div>
            </header>
            <div class="filter-container">
                <div class="form-container">
                    <form id="form-filter" action="{{ route('site.exhibitions') }}" method="get">
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
                            <select name="subcat" class="selection">
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
                            <button type="submit" class="search-bt filter-btn-js">{{ trans('site.btn_search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="main-catalog-block">
                <div id="m-grid-o" class="masonry catalog-items">
                    @foreach($catalogItems as $item)
                        <div class="grid catalog-item grid-item">
                            <div class="img-bg">
                                <div class="img-box">
                                    <a href="{{ route('site.exhibitions.item', ['slug' => $item->slug]) }}">
                                    <img src="{{ $item->getFirstMediaUrl('works') }}" alt="{{ $item->name }}"/>
                                    <div class="owerlay-item">
                                        <div class="owerlay-item-content">
                                         <div class="item-title-isite">{{ $item->name }}</div>
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination-wrapper">
                @if($catalogItems)
                {{ $catalogItems->links() }}
                @endif
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
