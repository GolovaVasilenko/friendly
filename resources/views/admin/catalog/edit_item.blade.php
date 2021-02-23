@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('catalog.items.edit')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
     @php
        function makeCatalogCategoriesTree($items, $catalogItem, $level = 0)
        {
            $output = '';
            $separator = '';
            if($level) {
                for($i = 0; $i < $level; $i++ ) {
                    $separator .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            foreach($items as $category) {
                $output .= '<p>' . $separator . '<label>
                        <input
                            type="checkbox"
                            name="categories[]"';
                            $output .= 'value="' . $category->id . '"';
                            foreach($catalogItem->categories as $cat) {
                                if($cat->id == $category->id) $output .= ' checked ';
                            }
                        $output .= '/> ';
                        $output .= $category->name ;
                    $output .= '</label></p>';
                    if (isset($category->children)) {
                    $level++;
                    $output .= makeCatalogCategoriesTree($category->children, $catalogItem, $level);
                }
            }
            return $output;
        }
     @endphp
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.catalog.items.update', ['item' => $catalogItem]) }}" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $catalogItem->id }}"/>
                                <div class="form-group">
                                    <label for="catalog-title">{{ trans('admin.title') }}</label>
                                    <input id="catalog-title" class="form-control" type="text" name="name" value="{{ $catalogItem->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-slug">{{ trans('admin.url') }}</label>
                                    <input id="catalog-slug" class="form-control" type="text" name="slug" value="{{ $catalogItem->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="body-page">{{ trans('admin.description') }}</label>
                                    <textarea id="body-page" class="form-control" name="description">{{ $catalogItem->description }}</textarea>
                                </div>
                                @if($itemImgUrl = $catalogItem->getFirstMediaUrl('works'))
                                    <div class="image-box col-8" style="margin:auto">
                                        <img src="{{ $itemImgUrl }}" />
                                        <a href="{{ route('remove.item.image', [$catalogItem]) }}" class="fa fa-times remove-image"></a>
                                        <a href="#" class="fa fa-edit edit-image" data-toggle="modal" data-target="#modal-default"></a>
                                    </div>

                                @else
                                    <div class="form-group">
                                        <label for="item-image">{{ trans('admin.add_images') }}</label>
                                        <input id="catalog-title" class="form-control" type="file" name="work_img">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <button type="submit" class="btn btn-outline-info float-right">
                                    {{ trans('admin.save') }}
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="display_home">
                                        <input type="checkbox" id="display_home" name="display_home" value="1" @if($catalogItem->display_home) checked @endif />
                                        &nbsp;{{ trans('admin.display_home') }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <h3>{{ trans('admin.categories') }}</h3>
                                    {!! makeCatalogCategoriesTree($catalogList, $catalogItem) !!}

                                </div>
                                <div class="form-group">
                                    <h4>{{ trans('admin.direction') }}</h4>
                                    <select class="form-control" name="categories[]">
                                        @foreach($catDirection as $catDir)
                                            <option value="{{ $catDir->id }}"
                                            @foreach($catalogItem->categories as $cat)
                                                @if($cat->id == $catDir->id) selected @endif
                                            @endforeach
                                            >{{ $catDir->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h4>{{ trans('admin.genres') }}</h4>
                                    <select class="form-control" name="categories[]">
                                        @foreach($catGenres as $catGen)
                                            <option value="{{ $catGen->id }}"
                                                @foreach($catalogItem->categories as $cat)
                                                    @if($cat->id == $catGen->id) selected @endif
                                                @endforeach
                                            >{{ $catGen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="item_cdate">{{ trans('admin.date_create') }}</label>
                                    <input id="item_cdate" class="form-control" type="text" name="cdate" value="{{ $catalogItem->cdate }}">
                                </div>
                                <div class="form-group">
                                    <label for="item_size">{{ trans('admin.data_size') }}</label>
                                    <input id="item_size" class="form-control" type="text" name="size" value="{{ $catalogItem->size }}">
                                </div>
                                <div class="form-group">
                                    <label for="item_material">{{ trans('admin.data_material') }}</label>
                                    <input id="item_material" class="form-control" type="text" name="workmanship" value="{{ $catalogItem->workmanship }}">
                                </div>
                                <div class="form-group">
                                    <label for="item_collection">{{ trans('admin.collection') }}</label>
                                    <input id="item_collection" class="form-control" type="text" name="collection" value="{{ $catalogItem->collection }}">
                                </div>
                                <div class="form-group">
                                    <label for="item_execution_technique">{{ trans('admin.data_execution_technique') }}</label>
                                    <input id="item_execution_technique" class="form-control" type="text" name="execution_technique" value="{{ $catalogItem->execution_technique }}">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-meta-title">{{ trans('admin.meta_title') }}</label>
                                    <input id="catalog-meta-title" class="form-control" type="text" name="m_title" value="{{ $catalogItem->m_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-meta-title">{{ trans('admin.meta_description') }}</label>
                                    <textarea class="form-control" name="m_description">{{ $catalogItem->m_description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

     <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title"></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     @php $media = $catalogItem->getMedia('works')->first() ?? null @endphp
                     <form action="{{ route('admin.media.update') }}" method="post">
                         @csrf
                         @method('put')
                         <input value="{{ $media->id ?? '' }}" name="id" type="hidden" />
                         <div class="form-group">
                             <label for="media-title">{{ trans('admin.title') }}</label>
                             <input id="media-title" class="form-control" name="title" type="text" value="{{ $media->title ?? '' }}" />
                         </div>
                         <div class="form-group">
                             <label for="media-alt">{{ trans('admin.alt') }}</label>
                             <input id="media-alt" class="form-control" name="alt" type="text" value="{{ $media->alt ?? '' }}" />
                         </div>
                         <div class="form-group">
                             <label for="media-desc">{{ trans('admin.description') }}</label>
                             <textarea id="media-desc" class="form-control" name="description">
                            {{ $media->description ?? '' }}
                        </textarea>
                         </div>
                         <input type="submit" class="btn btn-primary" value="{{ trans('admin.save') }}" />
                     </form>
                 </div>

             </div>
             <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
     </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script>
        jQuery(document).ready(function($) {
            CKEDITOR.replace('body-page');
        });
    </script>
@endsection

