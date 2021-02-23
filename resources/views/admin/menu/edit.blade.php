@extends('layouts.admin')
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="edit-item-menu-container" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('admin.edit') }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>{{ trans('admin.new_item') }}</h4>
                                        <form method="post" action="{{ route('admin.menu.item.update') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="input-name">{{ trans('admin.item_name') }}</label>
                                                <input type="text" name="name" class="form-control" value="{{ $itemEdit->name ?? '' }}" />
                                                <input type="hidden" name="id" value="{{ $itemEdit->id ?? '' }}">
                                                <input type="hidden" name="menu_id" value="{{ $menu_id ?? '' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="input-link">{{ trans('admin.item_link') }}</label>
                                                <input type="text" name="link" class="form-control" value="{{ $itemEdit->link ?? '' }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="input-icon">{{ trans('admin.item_icon') }}</label>
                                                <input type="text" name="icon" class="form-control" value="{{ $itemEdit->icon ?? '' }}" />
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-outline-info" value="{{ trans('admin.save') }}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
