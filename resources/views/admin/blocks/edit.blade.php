@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('blocks.edit')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.blocks.update', ['block' => $block]) }}" role="form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title-block">{{ trans('admin.title') }}</label>
                                    <input type="text" class="form-control" id="title-block" name="title" value="{{ $block->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="subtitle-block">{{ trans('admin.subtitle') }}</label>
                                    <input type="text" class="form-control" id="subtitle-block" name="subtitle" value="{{ $block->subtitle }}">
                                </div>
                                <div class="form-group">
                                    <label for="body-block">{{ trans('admin.content') }}</label>
                                    <textarea id="body-block" class="form-control richEditor" name="text">
                                        {{ $block->text }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="link-block">{{ trans('admin.url') }}</label>
                                    <input type="text" class="form-control" id="link-block" name="link" value="{{ $block->link }}">
                                </div>
                                <div class="form-group">
                                    <label for="link_text-block">{{ trans('admin.text_link') }}</label>
                                    <input type="text" class="form-control" id="link_text-block" name="text_link" value="{{ $block->text_link }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <input type="submit" value="{{ trans('save') }}" class="btn btn-block btn-success btn-flat col-md-5 float-right"/>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="select-page">{{ trans('admin.page') }}</label>
                                    <select id="select-page" class="form-control" name="page_id">
                                        @foreach($pages as $page)
                                            <option @if($page->id == $block->page_id) selected @endif value="{{ $page->id }}">{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($srcImg = $block->getFirstMediaUrl('blocks'))
                                    <div class="image-box">
                                        <img src="{{ $srcImg }}" width="100%"/>
                                        <a href="{{ route('remove.block.image', ['block' => $block]) }}" class="fa fa-times remove-image"></a>
                                    </div>
                                @else
                                <div class="form-group">
                                    <label for="block_img">{{ trans('admin.add_images') }}</label>
                                    <input type="file" class="form-control" id="block_img" name="block_img">
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h4>Styles</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="style-id-block">Style ID</label>
                                    <input type="text" class="form-control" id="style-id-block" name="style_id" value="{{ $block->style_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="style-class-block">Style Class</label>
                                    <input type="text" class="form-control" id="style-class-block" name="style_class" value="{{ $block->style_class }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script>
        jQuery(document).ready(function($) {
            CKEDITOR.replace('body-block');
        });
    </script>
@endsection

