@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('posts')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.albums.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" multiple name="media[]" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">{{ trans('admin.chose_file') }}</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text" id="">{{ trans('admin.upload') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-outline-info btn-sm float-right" href="{{ route('admin.media.index') }}">{{ trans('admin.uploads_media') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">

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
                                                <a href="{{ route('admin.albums.edit', ['media' => $item, 'id' => $item->id]) }}" type="button" class="btn btn-outline-info"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="removable-item btn btn-outline-danger"><i class="fa fa-times"></i></a>
                                                <form class="removable-form" method="post" action="{{ route('admin.albums.destroy', [$item]) }}">{{ csrf_field() }} {{ method_field("delete") }} </form>
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
