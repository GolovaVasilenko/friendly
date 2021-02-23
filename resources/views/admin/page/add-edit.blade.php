@extends('layouts.admin')
@if($method)
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('pages.edit', $page)]) @endsection
@else
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('pages.add')]) @endsection
@endif
@section('pageTitle') {{ $pageTitle }} @endsection

@section('content')
    <div class="content">
        <form method="POST" action="{{ route($route, $params) }}" role="form" >
            @csrf
            @if($method)
                @method($method)
            @endif
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title-page">{{ trans('admin.title') }}</label>
                                    <input type="text" class="form-control" @if(!isset($method)) id="title-page" @endif placeholder="Title" name="title" value="@empty($page->title) @else {{ $page->title  }} @endempty">
                                </div>
                                <div class="form-group">
                                    <label for="slug-page">{{ trans('admin.url') }}</label>
                                    <input type="text" class="form-control" @if(!isset($method)) id="slug-page" @endif placeholder="URL" name="slug" value="@empty($page->slug) @else {{ $page->slug  }} @endempty">
                                </div>
                                <div class="form-group">
                                    <label for="body_page">{{ trans('admin.content') }}</label>
                                    &nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-sm btn-primary get-data-media-js" data-toggle="modal" data-target="#modal-media">Media</a>
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-video">Video</a>
                                    <textarea id="body_page" class="form-control richEditor" name="body">
                                        @empty($page->body) @else {{ $page->body  }} @endempty
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <input type="submit" value="{{ trans('admin.save') }}" class="btn btn-block btn-success btn-flat col-md-5 float-right"/>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta-title-page">{{ trans('admin.meta_title') }}</label>
                                    <input type="text" class="form-control" id="meta-title-page" placeholder="Meta title" name="meta_title" value="@empty($page->meta_title) @else {{ $page->meta_title  }} @endempty">
                                </div>
                                <div class="form-group">
                                    <label for="meta-desc-page">{{ trans('admin.meta_description') }}</label>
                                    <textarea id="meta-desc-page" name="meta_description" class="form-control">
                                        @empty($page->meta_description) @else {{ $page->meta_description  }} @endempty
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <div class="modal fade" id="modal-media" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="items-image-container">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary get-selected-images-js" data-dismiss="modal" aria-label="Close">Insert Image</button>
                    <button type="button" class="btn btn-primary get-selected-gallery-js" data-dismiss="modal" aria-label="Close">Create Gallery</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- modal video -->
    <div class="modal fade" id="modal-video" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert Url Video</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="items-image-container">
                        <form id="insertVideo">
                            <div class="form-group">
                                <label for="video-link">Video link</label>
                                <input id="video-link" class="form-control" type="text" name="videoLink" />
                            </div>
                            <div class="form-group">
                                <select id="type" class="form-control" name="typeContent">
                                    <option value="image">Image link</option>
                                    <option value="text">Simple text</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <input id="content" class="form-control" type="text" name="content" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary get-insert-video-js" data-dismiss="modal" aria-label="Close">Insert Video</button>
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
            $('#title-page').on('keyup', function() {
                $('#slug-page').val(window.slugify($(this).val(), {
                    lower: true
                }));
            });

            $('.get-insert-video-js').on('click', function() {
                let output = '';
                let link = $('input#video-link').val();
                let type = $('select#type').val();
                let content = $('input#content').val();

                output += '<div class="videoPlayer">';
                if(type === 'text') {
                    output += '<a href="' + link + '">' + content + '</a></div>';
                } else {
                    output += '<a href="' + link + '" data-poster="' + content + '"><img src="' + content + '"></a></div>';
                }
                var element = CKEDITOR.dom.element.createFromHtml( output );
                CKEDITOR.instances.body_page.insertElement( element );
            });

            $('.get-data-media-js').on('click', function() {
                $.ajax({
                    method: 'get',
                    url: "{{ route('ajaxDataMedia') }}",
                    data: {},
                    success: function(data) {
                        let output = '';
                        $.each(data, function(i, v) {
                            output += '<div class="image-item">';
                            output += '<label>';
                            output += '<img src="' + v + '" >';
                            output += '<input name="media-selected" type="checkbox" value="' + v + '">';
                            output += '</label>';
                            output += '</div>';
                        });
                        $('.items-image-container').html(output);
                    }
                });
            });

            $('.get-selected-gallery-js').on('click', function() {
                let output = '<div class="mediaGallery">';
                $.each($('input[name=media-selected]:checked'), function(i, v) {
                    output += '<a href="' + $(v).val() + '">';
                    output += '<img src="' + $(v).val() + '" alt="" /></a>';
                });
                output += '</div>';
                var element = CKEDITOR.dom.element.createFromHtml( output );
                CKEDITOR.instances.body_page.insertElement( element );
            });

            $('.get-selected-images-js').on('click', function() {
                $.each($('input[name=media-selected]:checked'), function(i, v) {
                    var element = CKEDITOR.dom.element.createFromHtml( '<img src="' + $(v).val() + '" alt="" />' );
                    CKEDITOR.instances.body_page.insertElement( element );
                });
            });

            CKEDITOR.replace('body_page', {
                filebrowserUploadUrl: "{{route('upload-ckeditor', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        });
    </script>
@endsection
