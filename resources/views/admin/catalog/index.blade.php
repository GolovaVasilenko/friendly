@extends('layouts.admin')
@section('pageTitle') {{ $pageTitle }} @endsection
@section('breadcrumbs') @include('partials.admin_breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('catalog')]) @endsection
@section('content')
    @php
        function makeCatalogCategoriesTree($items, $level = 0)
        {
            $output = '';
            $separator = '';
            if($level) {
                for($i = 0; $i < $level; $i++ ) {
                    $separator .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            foreach($items as $item) {

                    $output .= '<tr>';
                    $output .= '<td>' . $separator . $item->name . '</td>';
                    $output .= '<td>' . $item->slug . '</td>';
                    $output .= '<td><input type="number" class="edit-position-js" value="' . $item->position . '" data-id="' . $item->id . '" style="width:60px;text-align:center;" /> <button class="btn btn-primary btn-sm position-save-btn-js" style="display:none;margin:-4px 0 0 4px;font-size:10px;">' . trans("admin.save") . '</button></td>';
                    $output .= '<td width="300">';
                        $output .= '<a href="' . route('admin.catalog.edit', ['catalog' => $item]) . '" class="btn btn-primary btn-sm">' . trans('admin.edit') . '</a>';
                        $output .= '<a href="#" class="removable-item btn btn-danger btn-sm">' . trans('admin.delete') . '</a>';
                        $output .= '<form class="removable-form" method="post" action="' . route('admin.catalog.destroy', ['catalog' => $item]) . '">';
                            $output .= csrf_field();
                            $output .= method_field("delete");
                        $output .= '</form>';
                    $output .= '</td>';
                $output .= '</tr>';
                if (isset($item->children)) {
                    $level++;
                    $output .= makeCatalogCategoriesTree($item->children, $level);
                }

            }
            return $output;
        }

    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="col-md-3">
                                <a href="{{ route('admin.catalog.create') }}">
                                    <button type="button" class="btn btn-block bg-gradient-success btn-flat">{{ trans('admin.create_new_category') }}</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>{{ trans('admin.title') }}</th>
                                    <th>{{ trans('admin.url') }}</th>
                                    <th>{{ trans('admin.position') }}</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                                {!! makeCatalogCategoriesTree($catalogList) !!}
                            </table>
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

            $('.edit-position-js').on('change', function() {
                $(this).closest('td').find('.position-save-btn-js').show(400);
            });
            $('.position-save-btn-js').on('click', function() {
                let id = $(this).closest('td').find('input').data('id');
                let position = $(this).closest('td').find('input').val();

                $.ajax({
                    method: "POST",
                    url: "{{ route('change.position.category') }}",
                    data: {"id": id, "position": position},
                    success: function(response) {
                        $('.position-save-btn-js').hide(200);
                    }
                });
            });

        });
    </script>
@endsection
