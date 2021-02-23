@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('post.edit', $post)]) @endsection
@section('pageTitle') {{ $pageTitle . " " . $post->title }} @endsection
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.posts.update', [$post]) }}" role="form" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title-page">{{ trans('admin.title') }}</label>
                                    <input type="text" class="form-control" id="title-page" placeholder="Title" name="title" value="{{ $post->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug-page">{{ trans('admin.url') }}</label>
                                    <input type="text" class="form-control" id="slug-page" placeholder="URL" name="slug" value="{{ $post->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="intro-page">{{ trans('admin.excerpt') }}</label>
                                    <textarea id="intro-page" class="form-control richEditor" name="intro">
                                        {{ $post->intro }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body_page">{{ trans('admin.content') }}</label>
                                    <a href="#" class="btn btn-sm btn-primary get-data-media-js" data-toggle="modal" data-target="#modal-media">Media</a>
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-video">Video</a>
                                    <textarea id="body_page" class="form-control richEditor" name="body">
                                        {{ $post->body }}
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
                                    <h4>{{ trans('admin.categories') }}</h4>
                                    @foreach($rubrics as $rubric)
                                        <p>
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    name="rubrics[]"
                                                    value="{{ $rubric->id }}"
                                                    @foreach($post->rubrics as $pr)
                                                        @if($rubric->id == $pr->id) checked @endif
                                                    @endforeach
                                                />
                                                {{ $rubric->title }}
                                            </label>
                                        </p>
                                    @endforeach
                                </div>
                                <hr>
                                <h3>{{ trans('admin.images') }}</h3>
                                @if($postImgUrl = $post->getFirstMediaUrl('images'))
                                    <div class="image-box">
                                        <img src="{{ $postImgUrl }}" alt="{{ $post->title }}" />
                                        <a href="{{ route('remove.post.image', [$post]) }}" class="fa fa-times remove-image"></a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="post-image">{{ trans('admin.add_images') }}</label>
                                        <input type="file" class="form-control" id="post-image" placeholder="" name="image" value="">
                                    </div>
                                @endif
                                <hr>
                                <div class="form-group">
                                    <label for="meta-title-page">{{ trans('admin.meta_title') }}</label>
                                    <input type="text" class="form-control" id="meta-title-page" placeholder="Meta title" name="meta_title" value="{{ $post->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta-desc-page">{{ trans('admin.meta_description') }}</label>
                                    <textarea id="meta-desc-page" name="meta_description" class="form-control">
                                        {{ $post->meta_description }}
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
                    <button type="button" class="btn btn-primary get-selected-images-js" data-dismiss="modal" aria-label="Close">Insert Image</button> &nbsp;&nbsp;
                    <button type="button" class="btn btn-primary get-selected-gallery-js" data-dismiss="modal" aria-label="Close">Create Gallery</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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

            CKEDITOR.replace('body_page');
            CKEDITOR.replace('intro-page');
        });
    </script>
@endsection

