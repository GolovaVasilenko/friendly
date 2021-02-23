@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('rubrics.edit', $rubric)]) @endsection
@section('pageTitle') {{ $pageTitle . " " . $rubric->title }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <form method="post" action="{{ route('admin.rubrics.update', [$rubric]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ trans('admin.category') }}</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="0">{{ trans('admin.root_item') }}</option>
                                        @foreach($rubrics as $r)
                                            <option value="{{ $r->id }}">{{ $r->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rubric-title">{{ trans('admin.title') }}</label>
                                    <input id="rubric-title" class="form-control" type="text" name="title" value="{{ $rubric->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="rubric-slug">{{ trans('admin.url') }}</label>
                                    <input id="rubric-slug" class="form-control" type="text" name="slug" value="{{ $rubric->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="rubric-description">{{ trans('admin.description') }}</label>
                                    <textarea id="rubric-description" name="description">{{ $rubric->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rubric-meta_title">{{ trans('admin.meta_title') }}</label>
                                    <input id="rubric-meta_title" class="form-control" type="text" name="meta_title" value="{{ $rubric->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="rubric-meta_description">{{ trans('admin.meta_description') }}</label>
                                    <textarea id="rubric-meta_description" class="form-control" name="meta_description">{{ $rubric->meta_description }}</textarea>
                                </div>
                                @if($rubricImgUrl = $rubric->getImage())
                                    <div class="image-box">
                                        <img src="{{ $rubricImgUrl->getUrl() }}" alt="{{ $rubric->title }}" />
                                        <a href="{{ route('remove.rubric.image', [$rubric]) }}" class="fa fa-times remove-image"></a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="user-avatar">{{ trans('admin.add_images') }}</label>
                                        <input type="file" class="form-control" id="user-avatar" placeholder="" name="catImage" value="">
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block bg-gradient-success btn-flat">{{ trans('admin.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            CKEDITOR.replace('rubric-description');
        });
    </script>
@endsection
