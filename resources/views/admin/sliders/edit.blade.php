@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('sliders.edit')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.sliders.update', ['slider' => $slider]) }}" role="form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title-slider">{{ trans('admin.title') }}</label>
                                    <input type="text" class="form-control" id="title-slider" name="title" value="{{ $slider->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="subtitle-slider">{{ trans('admin.subtitle') }}</label>
                                    <input type="text" class="form-control" id="subtitle-slider" name="subtitle" value="{{ $slider->subtitle }}">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="url-slider">{{ trans('admin.url') }}</label>
                                    <input type="text" class="form-control" id="url-slider" name="url" value="{{ $slider->url }}">
                                </div>
                                <div class="form-group">
                                    <label for="text_link-slider">{{ trans('admin.text_link') }}</label>
                                    <input type="text" class="form-control" id="text_link-slider" name="text_link" value="{{ $slider->text_link }}">
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
                                    <input type="text" class="form-control" id="type-slider" name="type" value="{{ $slider->type }}">
                                    <p>{{ trans('admin.menu_id_exemple') }}</p>
                                </div>
                                <hr>
                                @if($srcSlider = $slider->getFirstMediaUrl('sliders'))
                                    <div class="image-box">
                                        <img src="{{ $srcSlider }}" alt="{{ $slider->title }}" />
                                        <a href="{{ route('remove.slider.image', [$slider]) }}" class="fa fa-times remove-image"></a>
                                    </div>
                                @else
                                <div class="form-group">
                                    <label for="slider">{{ trans('admin.add_images') }}</label>
                                    <input type="file" class="form-control" id="slider" name="slider" value="">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
