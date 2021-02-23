@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('catalog.items.add')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.catalog.items.store') }}" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="item-image">{{ trans('admin.add_images') }}</label>
                                    <input id="catalog-image" class="form-control" type="file" name="work_img">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-title">{{ trans('admin.title') }}</label>
                                    <input id="catalog-title" class="form-control" type="text" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-slug">{{ trans('admin.url') }}</label>
                                    <input id="catalog-slug" class="form-control" type="text" name="slug">
                                </div>
                                <div class="form-group">
                                    <label for="body-page">{{ trans('admin.description') }}</label>
                                    <textarea id="body-page" class="form-control" name="description"></textarea>
                                </div>
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
                                    <input type="checkbox" id="display_home" name="display_home" value="1" />
                                        &nbsp;{{ trans('admin.display_home') }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <h3>{{ trans('admin.categories') }}</h3>
                                    @foreach($catalogList as $category)
                                        <p>
                                            <label>
                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" />
                                                {{ $category->name }}
                                            </label>
                                        </p>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <h4>{{ trans('admin.direction') }}</h4>
                                    <select class="form-control" name="categories[]">
                                        @foreach($catDirection as $catDir)
                                        <option value="{{ $catDir->id }}">{{ $catDir->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h4>{{ trans('admin.genres') }}</h4>
                                    <select class="form-control" name="categories[]">
                                        @foreach($catGenres as $catGen)
                                            <option value="{{ $catGen->id }}">{{ $catGen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="item_cdate">{{ trans('admin.date_create') }}</label>
                                    <input id="item_cdate" class="form-control" type="text" name="cdate">
                                </div>
                                <div class="form-group">
                                    <label for="item_size">{{ trans('admin.data_size') }}</label>
                                    <input id="item_size" class="form-control" type="text" name="size">
                                </div>
                                <div class="form-group">
                                    <label for="item_material">{{ trans('admin.data_material') }}</label>
                                    <input id="item_material" class="form-control" type="text" name="workmanship">
                                </div>
                                <div class="form-group">
                                    <label for="item_collection">{{ trans('admin.collection') }}</label>
                                    <input id="item_collection" class="form-control" type="text" name="collection">
                                </div>
                                <div class="form-group">
                                    <label for="item_execution_technique">{{ trans('admin.data_execution_technique') }}</label>
                                    <input id="item_execution_technique" class="form-control" type="text" name="execution_technique">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-meta-title">{{ trans('admin.meta_title') }}</label>
                                    <input id="catalog-meta-title" class="form-control" type="text" name="m_title">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-meta-title">{{ trans('admin.meta_description') }}</label>
                                    <textarea class="form-control" name="m_description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#catalog-title').on('keyup', function() {
                $('#catalog-slug').val(window.slugify($(this).val(), {
                    lower: true
                }));
            });

            CKEDITOR.replace('body-page');
        });
    </script>
@endsection
