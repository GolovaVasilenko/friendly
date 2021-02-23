@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('settings')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ trans('admin.settings_list') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach($settings as $setting)
                                <div class="setting-item row">
                                    <div class="col-md-2">{{ $setting->Label }}</div>
                                    <div class="col-md-6">
                                        <div id="{{ $setting->id }}" class="form-group">
                                            @include('admin/settings/_' . $setting->type)
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if($setting->type !== 'file')
                                        <a href="#" data-id="{{ $setting->id }}" class="settings-item-edit-js btn btn-primary btn-sm">{{ trans('admin.edit') }}</a>&nbsp;
                                        <form class="edit-form" method="post" action="{{ route('settings.update', ['id' => $setting->id ]) }}" style="display:inline;">
                                            <input type="hidden" name="key" value="{{ $setting->key ?? '' }}"/>
                                            <input type="hidden" name="value" value=""/>
                                            {{ csrf_field() }}
                                        </form>

                                        @endif
                                        <a href="#" class="removable-item btn btn-danger btn-sm">{{ trans('admin.delete') }}</a>
                                        <form class="removable-form" method="post" action="{{ route('settings.destroy', ['key' => $setting->key]) }}">
                                            {{ csrf_field() }} {{ method_field("delete") }}
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">{{ trans('admin.add_settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('settings.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputLabel">{{ trans('admin.settings_label') }}</label>
                                    <input type="text" class="form-control" id="inputLabel" name="label">
                                </div>
                                <div class="form-group">
                                    <label for="inputKey">{{ trans('admin.settings_key') }}</label>
                                    <input type="text" class="form-control" id="inputKey" name="key">
                                </div>
                                <div class="form-group">
                                    <label for="inputSelect">{{ trans('admin.fields_type') }}</label>
                                    <select  id="inputSelect" name="type" class="form-control">
                                        @foreach($types as $type => $name)
                                        <option value="{{ $type }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputLang">{{ trans('admin.languages') }}</label>
                                    <select  id="inputLang" name="locale" class="form-control">
                                        <option value="all">{{ trans('admin.lang_all') }}</option>
                                        @foreach(config('app.locales') as $locale)
                                            <option value="{{ $locale }}">{{ $locale }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary" value="Save"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    jQuery(document).ready(function($) {
        $('.settings-item-edit-js').on('click', function(e) {
            e.preventDefault();
            let form = $(this).next('form');
            let id = $(this).data('id');
            let value = $('#'+id).find('.input-value').val();
            form.find('input[name=value]').val(value);
            form.submit();
        });
    });
</script>
@endsection
