@extends('layouts.admin')

@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('dashboard')]) @endsection

@section('content')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $postCount }}</h3>

                            <p>{{ trans('admin.posts') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                        <a href="{{ route('admin.posts.index') }}" class="small-box-footer">
                            {{ trans('admin.more') }} <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $workCount }}</h3>

                            <p>{{ trans('admin.works') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-photo-video"></i>
                        </div>
                        <a href="{{ route('admin.catalog.items.index') }}" class="small-box-footer">
                            {{ trans('admin.more') }} <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $usersCount }}</h3>

                            <p>{{ trans('admin.users') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">
                            {{ trans('admi.more') }} <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
