@extends('layouts.admin')
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('menu.items')]) @endsection
@section('pageTitle') {{ $pageTitle }} @endsection
@section('content')
    @php
        function buildMenu($menuItems, $menu)
        {
            $output = '';
            foreach ($menuItems as $item) {
                if (isset($item->children)) {
                    $output .= '<li class="dd-item" data-id="' . $item->id . '" data-position="' . $item->position . '">
                          <div class="dd-handle">' . $item->name . '</div>
                          <div class="action-item-menu">
                          <a class="edit-item-menu" href="' . route('admin.menu.item.edit', ['menu_id' => $menu->id, 'id' => $item->id]) . '"><i class="fa fa-edit"></i></a>
                          <a class="remove-item-menu" href="' . route('admin.menu.item.delete', ['menu_id' => $menu->id, 'id' => $item->id]) . '"><i class="fa fa-times"></i></a>
                            </div>
                            <ol class="dd-list">';
                                $output .= buildMenu($item->children, $menu);
                            $output .= '</ol>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="dd-item" data-id="' . $item->id . '" data-position="' . $item->position . '">
                        <div class="dd-handle">' . $item->name . '</div>
                        <div class="action-item-menu">
                        <a class="edit-item-menu" href="' . route('admin.menu.item.edit', ['menu_id' => $menu->id, 'id' => $item->id]) . '"><i class="fa fa-edit"></i></a>
                        <a class="remove-item-menu" href="' . route('admin.menu.item.delete', ['menu_id' => $menu->id, 'id' => $item->id]) . '"><i class="fa fa-times"></i></a>
                        </div>';
                    $output .= '</li>';
                }
            }
            return $output;
        }
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                {!! buildMenu($menuItems, $menu) !!}
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <strong>{{ $menu->title }}</strong>
                        </div>
                        <div class="card-body">
                            <h4>{{ trans('admin.new_item') }}</h4>
                            <form method="post" action="{{ route('admin.menu.item.store', [$menu]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="input-name">{{ trans('admin.item_name') }}</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="input-link">{{ trans('admin.item_link') }}</label>
                                    <input type="text" name="link" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="input-icon">{{ trans('admin.item_icon') }}</label>
                                    <input type="text" name="icon" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="select-parent">{{ trans('admin.item_parent') }}</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="0">{{ trans('admin.root_item') }}</option>
                                        @foreach($menu->items as $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
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

@endsection
