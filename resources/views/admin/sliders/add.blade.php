@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('sliders.add')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.sliders.store') }}" role="form" enctype="multipart/form-data" >
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title-slider">{{ trans('admin.title') }}</label>
                                    <input type="text" class="form-control" id="title-slider" placeholder="Title" name="title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="subtitle-slider">{{ trans('admin.subtitle') }}</label>
                                    <input type="text" class="form-control" id="subtitle-slider" placeholder="Slider ID" name="subtitle" value="">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="url-slider">{{ trans('admin.url') }}</label>
                                    <input type="text" class="form-control" id="url-slider" placeholder="URL" name="url" value="">
                                </div>
                                <div class="form-group">
                                    <label for="text_link-slider">{{ trans('admin.text_link') }}</label>
                                    <input type="text" class="form-control" id="text_link-slider" placeholder="Title" name="text_link" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <button type="submit" class="btn btn-outline-info float-right">{{ trans('admin.save') }}</button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="type-slider">{{ trans('admin.slider_ID') }}</label>
                                    <input type="text" class="form-control" id="type-slider" placeholder="Slider ID" name="type" value="">
                                    <p>{{ trans('admin.menu_id_exemple') }}</p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="slider">{{ trans('admin.add_images') }}</label>
                                    <input type="file" class="form-control" id="slider" name="slider" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
