@extends('layouts.admin')

@section('pageTitle') {{ $user->name }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            @if($avatarUrl = $user->userMeta->getFirstMediaUrl('avatars'))
                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" style="width:60%;display:block;height: auto;margin: 0 auto;border-radius:50%;" />
                            @else
                                <img src="{{ asset('admin/img/avatar.png') }}" alt="{{ $user->name }}"/>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="{{ route('users.index') }}" class="btn btn-primary">{{ trans('admin.user_list') }}</a>
                            <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary">{{ trans('admin.edit') }}</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" >
                                <tbody>
                                <tr>
                                    <td>{{ trans('admin.user_name') }}:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.email') }}:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.user_birthday') }}:</td>
                                    <td>{{ $user->userMeta->birthday }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.country') }}:</td>
                                    <td>{{ $user->userMeta->country }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('admin.city') }}:</td>
                                    <td>{{ $user->userMeta->city }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
