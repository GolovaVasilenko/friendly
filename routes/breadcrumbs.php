<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/* FRONT */
Breadcrumbs::for('main', function ($trail) {
    $trail->push('Home', route('main'));
});

/*Breadcrumbs::for('about', function ($trail) {
    $trail->parent('main');
    $trail->push('About', route('about'));
});*/
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('main');
    $trail->push('Profile', route('home'));
});

/* Back */
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(trans('admin.dashboard'), route('admin'));
});

Breadcrumbs::for('pages', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.pages'), route('pages.index'));
});
Breadcrumbs::for('pages.edit', function($trail, $page) {
    $trail->parent('pages');
    $trail->push(trans('admin.page_editing'), route('pages.edit', ['page' => $page]));
});
Breadcrumbs::for('pages.add', function($trail) {
    $trail->parent('pages');
    $trail->push(trans('admin.page_creation'), route('pages.create'));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.users'), route('users.index'));
});
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.settings'), route('settings'));
});
Breadcrumbs::for('rubrics', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.rubrics'), route('admin.rubrics.index'));
});
Breadcrumbs::for('rubrics.edit', function ($trail, $rubric) {
    $trail->parent('rubrics');
    $trail->push(trans('admin.edit_rubric'), route('admin.rubrics.edit', [$rubric]));
});

Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.posts'), route('admin.posts.index'));
});
Breadcrumbs::for('post.create', function ($trail) {
    $trail->parent('posts');
    $trail->push(trans('admin.post_create'), route('admin.posts.create'));
});
Breadcrumbs::for('post.edit', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push(trans('admin.post_edit'), route('admin.posts.edit', [$post]));
});

Breadcrumbs::for('catalog', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.catalog'), route('admin.catalog.index'));
});
Breadcrumbs::for('catalog.edit', function ($trail) {
    $trail->parent('catalog');
    $trail->push(trans('admin.catalog_edit'));
});
Breadcrumbs::for('catalog.add', function ($trail) {
    $trail->parent('catalog');
    $trail->push(trans('admin.catalog_add'));
});
Breadcrumbs::for('catalog.items', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.work_list'), route('admin.catalog.items.index'));
});
Breadcrumbs::for('catalog.items.add', function ($trail) {
    $trail->parent('catalog.items');
    $trail->push(trans('admin.create_new_catalog_item'));
});
Breadcrumbs::for('catalog.items.edit', function ($trail) {
    $trail->parent('catalog.items');
    $trail->push(trans('admin.update_new_catalog_item'));
});
Breadcrumbs::for('media', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.media'), route('admin.media.index'));
});
Breadcrumbs::for('menu', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.menu'), route('admin.menu.index'));
});
Breadcrumbs::for('menu.edit', function ($trail) {
    $trail->parent('menu');
    $trail->push(trans('admin.menu'));
});
Breadcrumbs::for('menu.items', function ($trail) {
    $trail->parent('menu');
    $trail->push(trans('admin.new_item'));
});
Breadcrumbs::for('sliders', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.sliders'), route('admin.sliders.index'));
});
Breadcrumbs::for('sliders.edit', function ($trail) {
    $trail->parent('sliders');
    $trail->push(trans('admin.edit_slider'));
});
Breadcrumbs::for('sliders.add', function ($trail) {
    $trail->parent('sliders');
    $trail->push(trans('admin.add_slider'));
});
Breadcrumbs::for('blocks', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.blocks'), route('admin.blocks.index'));
});
Breadcrumbs::for('blocks.edit', function ($trail) {
    $trail->parent('blocks');
    $trail->push(trans('admin.block_edit'));
});
Breadcrumbs::for('blocks.add', function ($trail) {
    $trail->parent('blocks');
    $trail->push(trans('admin.block_add'));
});
