@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('menu')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4>{{ trans('admin.select') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <table  class="table">
                                    @foreach($menus as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <a href="{{ route('admin.menu.edit', ['id' => $item->id]) }}" class="btn btn-outline-info float-right btn-action-menu">{{ trans('admin.rename_menu') }}</a>
                                                <a href="{{ route('admin.menu.items', ['menu_id' => $item->id]) }}" class="btn-action-menu btn btn-outline-info float-right">{{ trans('admin.edit') }}</a>
                                                <a href="#" class="removable-item btn btn-outline-danger float-right btn-action-menu">{{ trans('admin.delete') }}</a>
                                                <form method="post" action="{{ route('admin.menu.destroy', ['menu' => $item]) }}" id="remove-menu">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4>{{ trans('admin.create_menu') }}</h4>
                        </div>
                        <div class="card-body">
                            <form id="select-menu" method="post" action="{{ route('admin.menu.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{ trans('admin.item_name') }}</label>
                                    <input type="text" name="title" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('admin.item_type') }}</label>
                                    <input type="text" name="type" class="form-control" />
                                    <p>{{ trans('admin.menu_id_exemple') }}</p>
                                </div>
                                <input type="submit" class="btn btn-outline-info" value="{{ trans('admin.create') }}"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @isset($menu)
            <div class="row">
                <div class="col-lg-8">

                </div>
                <div class="col-lg-4">
                </div>
            </div>
            @endisset
        </div>
    </div>

@endsection
