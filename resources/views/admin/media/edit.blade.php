@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-blue">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9">
                                    <h3>{{ $pageTitle }} {{ $media->name }}</h3>
                                </div>
                                <div class="col-3">
                                    <a href="{{ route('admin.media.index') }}" class="btn btn-dark">{{ trans('admin.return_list') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
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
                            <div class="col-6">
                                <div class="image-box">
                                    <img src="{{ $media->getFullUrl() }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    </div>

@endsection
