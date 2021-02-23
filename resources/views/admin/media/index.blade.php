@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('media')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form action="{{ route('admin.media.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="input-group">
                                                <select class="form-control input-sm" name="typeModel">
                                                    <option value="images">Pages and Posts library</option>
                                                    <option value="noName">only Photo archive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" multiple name="media[]" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">{{ trans('admin.chose_file') }}</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" class="input-group-text" id="">{{ trans('admin.upload') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <form id="filter-form" action="{{ route('admin.media.filter') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class=""><i class="fas fa-sort-numeric-up"></i></div>
                                    <div class="form-group col-2">
                                        <select name="limit" class="form-control">
                                            @foreach(\App\Media::$limitList as $ll)
                                                <option value="{{ $ll }}" @if(\App\Media::$currentLimit == $ll) selected @endif>
                                                    {{ $ll }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <select name="collection_name" class="form-control">
                                            <option value="0">{{ trans('admin.select_collections') }}</option>
                                            @foreach($mediaCollections as $collection)
                                                <option value="{{ $collection }}">{{ trans('admin.collection_' . $collection) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-1">
                                        <button class="btn btn-outline-info float-right">{{ trans('admin.filter') }}</button>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-danger">{{ trans('admin.filter_reset') }}</a>
                                    </div>
                                    <div class="col-4">
                                        <div class="pagination-wrapper float-right">
                                            {{ $media->links() }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($media as $item)
                                <div class="col-2 flex-wrap" style="display:flex;flex-wrap: wrap">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media-image-box">
                                            <img src="{{ $item->getFullUrl() }}" width="150" />
                                            </div>
                                            <div class="media-info">
                                                <p>{{ trans('admin.title') }}: {{ $item->title ?? '' }}<br>
                                                {{ trans('admin.alt') }}: {{ $item->alt ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('admin.media.edit', ['id' => $item->id]) }}" type="button" class="btn btn-outline-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.media.remove', ['media' => $item]) }}" class="removable-item btn btn-outline-danger"><i class="fa fa-times"></i></a>
                                            <form class="removable-form" method="post" action="{{route('admin.media.remove', ['media' => $item]) }}">{{ csrf_field() }} {{ method_field("delete") }} </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="pagination-wrapper">
                            {{ $media->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
