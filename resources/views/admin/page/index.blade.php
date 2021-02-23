@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('pages')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="col-md-2">
                                <a href="{{ route('pages.create') }}">
                                    <button type="button" class="btn btn-block bg-gradient-success btn-flat">{{ trans('admin.create_new_page') }}</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ trans('admin.title') }}</th>
                                    <th>{{ trans('admin.url') }}</th>
                                    <th>{{ trans('admin.date_create') }}</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    type: "POST",
                    url: "{!! route('pages.ajax.data') !!}"
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
        });
    </script>
@endsection