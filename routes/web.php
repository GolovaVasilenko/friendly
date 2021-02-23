<?php
Route::group(['prefix' => App\Http\Middleware\LocaleAdminMiddleware::getLocale()], function(){

    Route::group(['prefix' => 'cabinet', 'namespace' => 'Admin'], function() {

        Route::get('/login', 'DashboardController@login')->name('admin.login');
        Route::post('/login', 'DashboardController@authenticate')->name('admin.authenticate');

        Route::group(['middleware' => 'admin'], function () {

            Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload-ckeditor');
            Route::post('ckeditor/media_upload', 'CKEditorController@uploadMedia')->name('uploadMedia');

            Route::post('/logout', 'DashboardController@logout')->name('admin.logout');

            Route::get('/', 'DashboardController@index')->name('admin');

            Route::post('/pages/list-ajax-data', 'PageController@pagesAjaxData')->name('pages.ajax.data');
            Route::resource('/pages', 'PageController');

            Route::get('/settings', 'SettingsController@index')->name('settings');
            Route::post('/settings/store', 'SettingsController@store')->name('settings.store');
            Route::delete('/settings/destroy/{key}', 'SettingsController@destroy')->name('settings.destroy');
            Route::post('/settings/update/{id}', 'SettingsController@updateItem')->name('settings.update');

            Route::resource('/users', 'UserController');
            Route::post('/users/data-ajax', 'UserController@dataAjax')->name('users.data.ajax');

            Route::get('/rubrics', 'RubricController@index')->name('admin.rubrics.index');
            Route::post('/rubrics/data-ajax', 'RubricController@dataAjax')->name('admin.rubrics.ajax');
            Route::post('/rubrics/store', 'RubricController@store')->name('admin.rubrics.store');
            Route::get('/rubrics/edit/{rubric}', 'RubricController@edit')->name('admin.rubrics.edit');
            Route::put('/rubrics/update/{rubric}', 'RubricController@update')->name('admin.rubrics.update');
            Route::delete('/rubrics/delete/{rubric}', 'RubricController@destroy')->name('admin.rubrics.delete');
            Route::get('/rubrics/remove-image/{rubric}', 'RubricController@destroyImage')->name('remove.rubric.image');

            Route::get('/posts', 'PostController@index')->name('admin.posts.index');
            Route::post('/posts/data-ajax', 'PostController@dataAjax')->name('admin.posts.ajax');
            Route::get('/posts/create', 'PostController@create')->name('admin.posts.create');
            Route::post('/posts/store', 'PostController@store')->name('admin.posts.store');
            Route::get('/posts/edit/{post}', 'PostController@edit')->name('admin.posts.edit');
            Route::put('/posts/update/{post}', 'PostController@update')->name('admin.posts.update');
            Route::delete('/posts/delete/{post}', 'PostController@destroy')->name('admin.posts.destroy');
            Route::get('/posts/remove-image/{post}', 'PostController@removePostImage')->name('remove.post.image');

            Route::get('/media', 'MediaController@index')->name('admin.media.index');
            Route::get('/media/edit/{media}', 'MediaController@edit')->name('admin.media.edit');
            Route::put('/media/update', 'MediaController@update')->name('admin.media.update');
            Route::post('/media/filter', 'MediaController@filter')->name('admin.media.filter');
            Route::post('/media/store', 'MediaController@store')->name('admin.media.store');
            Route::delete('/media/delete/{media}', 'MediaController@destroy')->name('admin.media.remove');
            Route::get('/media/ajax-data-media', 'MediaController@ajaxDataMedia')->name('ajaxDataMedia');

            Route::get('/menu', 'MenuController@index')->name('admin.menu.index');
            Route::post('/menu/store', 'MenuController@storeMenu')->name('admin.menu.store');
            Route::get('/menu/edit/{id}', 'MenuController@editMenu')->name('admin.menu.edit');
            Route::put('/menu/update', 'MenuController@updateMenu')->name('admin.menu.update');
            Route::delete('/menu/destroy/{menu}', 'MenuController@destroyMenu')->name('admin.menu.destroy');
            Route::get('/menu/items/{menu_id}', 'MenuController@items')->name('admin.menu.items');
            Route::post('/menu/items/store/{menu}', 'MenuController@itemStore')->name('admin.menu.item.store');
            Route::post('/menu/items/change_position', 'MenuController@updatePosition')->name('admin.menu.change_position');
            Route::put('/menu/items/updateItem', 'MenuController@updateItem')->name('admin.menu.item.update');
            Route::get('/menu/items/editItem/{menu_id}/{id}', 'MenuController@editItem')->name('admin.menu.item.edit');
            Route::get('/menu/items/destroy/{menu_id}/{id}', 'MenuController@destroyItem')->name('admin.menu.item.delete');

            Route::resource('catalog', 'CatalogController')->names('admin.catalog');
            Route::resource('catalog-items', 'CatalogItemController')->names('admin.catalog.items');
            Route::post('catalog-items/ajax', 'CatalogItemController@dataAjax')->name('admin.catalog.items.ajax');
            Route::get('catalog-items/remove-image/{item}', 'CatalogItemController@removeImage')->name('remove.item.image');
            Route::post('catalog/change-position', 'CatalogController@changePosition')->name('change.position.category');
            Route::post('catalog-items/change-position', 'CatalogItemController@changePosition')->name('catalog.items.change.position');
            Route::post('catalog-items/trigger-active', 'CatalogItemController@triggerActive')->name('catalog.items.trigger.active');

            Route::resource('sliders', 'SliderController')->names('admin.sliders');
            Route::post('sliders/data-ajax', 'SliderController@dataAjax')->name('admin.sliders.ajax');
            Route::get('sliders/remove-image/{slider}', 'SliderController@removeImage')->name('remove.slider.image');

            Route::resource('blocks', 'BlockController')->names('admin.blocks');
            Route::get('blocks/remove-image/{block}', 'BlockController@removeImage')->name('remove.block.image');

            Route::resource('albums', 'AlbumController')->names('admin.albums');
            Route::get('albums/remove-image/{album}', 'BlockController@removeImage')->name('remove.albums.image');
        });
    });
});

Route::get('setlocale/{lang}', function ($lang) {

    $referer = redirect()->back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    $segments = explode('/', $parse_url);

    if (in_array($segments[1], App\Http\Middleware\LocaleAdminMiddleware::getLanguages())) {
        unset($segments[1]);
    }

    if ($lang != App\Http\Middleware\LocaleAdminMiddleware::$mainLanguage) {
        array_splice($segments, 1, 0, $lang);
    }

    $url = request()->root() . implode("/", $segments);

    if(parse_url($referer, PHP_URL_QUERY)) {
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url);

})->name('setLocaleAdmin');

Route::get('locale/{lang}', function ($lang) {

    $referer = redirect()->back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    $segments = explode('/', $parse_url);

    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::getLanguages())) {
        unset($segments[1]);
    }

    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage) {
        array_splice($segments, 1, 0, $lang);
    }

    $url = request()->root() . implode("/", $segments);

    if(parse_url($referer, PHP_URL_QUERY)) {
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url);

})->name('setLocaleFront');

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function(){

    Route::get('/', 'PageController@main')->name('main');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('search/query', 'SearchController@index')->name('search_query');
    Route::get('search/results', 'SearchController@results')->name('search_results');

    Route::get('/gallery/work/{slug}', 'CatalogController@single')->name('site.exhibitions.item');
    Route::get('/gallery/{cat?}/{attr?}/{value?}', 'CatalogController@index')->name('site.exhibitions');
    Route::post('/gallery/ajaxValue', 'CatalogController@ajaxValue')->name('ajax.data.attr.value');

    Route::get('/blog/{rubric}', 'BlogController@index')->name('site.blog');
    Route::get('/blog/post/{slug}', 'BlogController@single')->name('site.blog.single');

    Route::get('/photo-album', 'PageController@pagePhotoAlbum')->name('site.page.photos');
    Route::get('/contacts', 'PageController@contacts')->name('site.page.contacts');

    Route::get('/{page}', 'PageController@show')->name('site.page.static');
});
Route::get('locale/{lang}', function ($lang) {

    $referer = redirect()->back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    $segments = explode('/', $parse_url);

    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::getLanguages())) {
        unset($segments[1]);
    }

    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage) {
        array_splice($segments, 1, 0, $lang);
    }

    $url = request()->root() . implode("/", $segments);

    if(parse_url($referer, PHP_URL_QUERY)) {
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url);

})->name('setLocaleFront');
