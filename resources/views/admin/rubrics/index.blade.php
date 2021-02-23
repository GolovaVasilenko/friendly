@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('rubrics')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-primary card-outline">

                        <div class="card-body">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ trans('admin.title') }}</th>
                                    <th>{{ trans('admin.url') }}</th>
                                    <th>{{ trans('admin.create') }}</th>
                                    <th width="320px">{{ trans('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card card-primary card-outline">
                        <form method="post" action="{{ route('admin.rubrics.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                    <input id="rubric-title" class="form-control" type="text" name="title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="rubric-slug">{{ trans('admin.url') }}</label>
                                    <input id="rubric-slug" class="form-control" type="text" name="slug" value="">
                                </div>
                                <div class="form-group">
                                    <label for="rubric-description">{{ trans('admin.description') }}</label>
                                    <textarea id="rubric-description" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rubric-meta_title">{{ trans('admin.meta_title') }}</label>
                                    <input id="rubric-meta_title" class="form-control" type="text" name="meta_title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="rubric-meta_description">{{ trans('admin.meta_description') }}</label>
                                    <textarea id="rubric-meta_description" class="form-control" name="meta_description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="user-avatar">{{ trans('admin.add_images') }}</label>
                                    <input type="file" class="form-control" id="user-avatar" placeholder="" name="catImage" value="">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-4">
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
            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{!! route('admin.rubrics.ajax') !!}"
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'slug', name: 'slug'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "language": {
                    'search': "{{ trans('admin.search') }}",
                    "lengthMenu": "{{ trans('admin.show') }} _MENU_ {{ trans('admin.entries') }}",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "{{ trans('admin.next') }}",
                        "previous":   "{{ trans('admin.previous') }}",
                    },
                    "infoEmpty": "{{ trans('admin.showing') }} 0 - 0 | 0 {{ trans('admin.entries') }}",
                    "info":    "{{ trans('admin.showing') }} _START_ - _END_ | _TOTAL_ {{ trans('admin.entries') }}"
                }
            });

            $('#rubric-title').on('keyup', function() {
                $('#rubric-slug').val(window.slugify($(this).val(), {
                    lower: true
                }));
            });

            CKEDITOR.replace('rubric-description');
        });
    </script>
@endsection
