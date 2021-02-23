@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('blocks')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="col-md-2">
                                <a href="{{ route('admin.blocks.create') }}">
                                    <button type="button" class="btn btn-block bg-gradient-success btn-flat">{{ trans('admin.block_add') }}</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>#ID</th>
                                    <th>{{ trans('admin.blocks') }}</th>
                                    <th>{{ trans('admin.pages') }}</th>
                                    <th>{{ trans('admin.date_create') }}</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                                @foreach($blocks as $block)
                                    <tr>
                                        <td>{{ $block->id }}</td>
                                        <td>{{ $block->title }}</td>
                                        <td>{{ $block->page->title }}</td>
                                        <td>{{ $block->created_at }}</td>
                                        <td>
                                            <a class="edit btn btn-primary btn-sm" href="{{ route('admin.blocks.edit', ['block' => $block]) }}">{{ trans('admin.edit') }}</a>
                                            <a class="removable-item btn btn-danger btn-sm" href="#">{{ trans('admin.delete') }}</a>
                                            <form class="removable-form" method="post" action="{{ route('admin.blocks.destroy', ['block' => $block]) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
