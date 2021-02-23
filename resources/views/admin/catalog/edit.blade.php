@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('catalog.edit')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.catalog.update', ['catalog' => $catalog]) }}" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="catalog-title">{{ trans('admin.title') }}</label>
                                    <input id="catalog-title" class="form-control" type="text" name="name" value="{{ $catalog->name ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-slug">{{ trans('admin.url') }}</label>
                                    <input id="catalog-slug" class="form-control" type="text" name="slug" value="{{ $catalog->slug ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-parent">{{ trans('admin.category_parent') }}</label>
                                    <select id="catalog-parent" class="form-control" name="parent_id">
                                        <option value="0">{{ trans('admin.root_item') }}</option>
                                        @foreach($categories as $category)
                                            <option @if($category->id == $catalog->parent_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="body-page">{{ trans('admin.description') }}</label>
                                    <textarea id="body-page" class="form-control" name="description">
                                        {{ $catalog->description ?? '' }}
                                    </textarea>
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
                                    <label for="catalog-meta-title">{{ trans('admin.meta_title') }}</label>
                                    <input id="catalog-meta-title" class="form-control" type="text" name="m_title" value="{{ $catalog->m_title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="catalog-meta-title">{{ trans('admin.meta_description') }}</label>
                                    <textarea class="form-control" name="m_description">{{ $catalog->m_description ?? '' }}</textarea>
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
            CKEDITOR.replace('body-page');
        });
    </script>
@endsection
