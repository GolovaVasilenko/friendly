@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('menu.edit')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4>{{ trans('admin.edit_menu') }}</h4>
                        </div>
                        <div class="card-body">
                            <form id="select-menu" method="post" action="{{ route('admin.menu.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>{{ trans('admin.item_name') }}</label>
                                    <input type="text" name="title" class="form-control" value="{{ $menu->title ?? '' }}"/>
                                    <input type="hidden" name="id" value="{{ $menu->id ?? '' }}"
                                </div>
                                <input type="submit" class="btn btn-outline-info" value="{{ trans('admin.save') }}"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

