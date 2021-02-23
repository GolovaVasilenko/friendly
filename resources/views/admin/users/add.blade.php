@extends('layouts.admin')

@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <form method="POST" action="{{ route('users.store') }}" role="form" enctype="multipart/form-data" >
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user-name">{{ trans('admin.user_name') }}</label>
                                    <input type="text" class="form-control" id="user-name" placeholder="" name="name" value="">
                                </div>
                                <div class="form-group">
                                    <label for="user-email">{{ trans('admin.email') }}</label>
                                    <input type="email" class="form-control" id="user-email" placeholder="" name="email" value="">
                                </div>
                                <div class="form-group">
                                    <label for="user-pass">{{ trans('admin.password') }}</label>
                                    <input type="text" class="form-control" id="user-pass" placeholder="" name="password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="user-role">{{ trans('admin.user_role') }}</label>
                                    <select class="form-control" id="user-role" name="role">
                                        <option value="{{ \App\User::ROLE_USER }}">user</option>
                                        <option value="{{ \App\User::ROLE_REDACTOR }}">redactor</option>
                                        <option value="{{ \App\User::ROLE_ADMIN}}">administrator</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <input type="submit" class="btn btn-success float-right" value="{{ trans('admin.save') }}"/>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user-avatar">{{ trans('admin.avatar') }}</label>
                                    <input type="file" class="form-control" id="user-avatar" placeholder="" name="avatar" value="">
                                </div>
                                <div class="form-group">
                                    <label for="user-country">{{ trans('admin.country') }}</label>
                                    <input type="text" class="form-control" id="user-country" placeholder="" name="meta[country]" value="">
                                </div>
                                <div class="form-group">
                                    <label for="user-city">{{ trans('admin.city') }}</label>
                                    <input type="text" class="form-control" id="user-city" placeholder="" name="meta[city]" value="">
                                </div>
                                <div class="form-group">
                                    <label for="user-birthday">{{ trans('admin.user_birthday') }}</label>
                                    <input type="date" class="form-control" id="user-birthday" placeholder="" name="meta[birthday]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
