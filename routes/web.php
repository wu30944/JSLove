<?php

/**
 * 后台路由
 */

/**后台模块**/
Route::group(['namespace' => 'Admin','prefix' => 'admin'], function (){

    Route::get('login','AdminsController@showLoginForm')->name('login');  //后台登陆页面

    Route::post('login-handle','AdminsController@loginHandle')->name('login-handle'); //后台登陆逻辑

    Route::get('logout','AdminsController@logout')->name('admin.logout'); //退出登录


    Route::get ( 'admin/test', ['as' => 'pos.test',function () {
        return view ( 'admin.pos.test' );
    } ]);

    /**需要登录认证模块**/
    Route::middleware(['auth:admin','rbac'])->group(function (){

        Route::resource('index', 'IndexsController', ['only' => ['index']]);  //首页

        Route::get('index/main', 'IndexsController@main')->name('index.main'); //首页数据分析

        Route::get('admins/status/{statis}/{admin}','AdminsController@status')->name('admins.status');

        Route::get('admins/delete/{admin}','AdminsController@delete')->name('admins.delete');

        Route::resource('admins','AdminsController',['only' => ['index', 'create', 'store', 'update', 'edit']]); //管理员

        Route::get('roles/access/{role}','RolesController@access')->name('roles.access');

        Route::post('roles/group-access/{role}','RolesController@groupAccess')->name('roles.group-access');

        Route::resource('roles','RolesController',['only'=>['index','create','store','update','edit','destroy'] ]);  //角色

        Route::get('rules/status/{status}/{rules}','RulesController@status')->name('rules.status');

        Route::resource('rules','RulesController',['only'=> ['index','create','store','update','edit','destroy'] ]);  //权限

        Route::resource('actions','ActionLogsController',['only'=> ['index','destroy'] ]);  //日志

        /*
         *  POS機
         * */
        Route::get('admin/pos/index','PosController@index')->name('pos.index');
        Route::post('admin/pos/create','PosController@create')->name('pos.create');
        Route::post('admin/pos/update_status','PosController@UpdateStatus')->name('pos.UpdateStatus');
        Route::get('admin/pos/order_detail','PosController@getOrderDetail')->name('pos.OrderDetail');
        Route::post('admin/pos/destroy_order','PosController@DestroyOrderByOrderSerialNo')->name('pos.DestroyOrder');

        /*
         *  口味資料維護
         * */
        Route::post('admin/flavor/edit','FlavorController@edit')->name('flavor.edit');
        Route::post('admin/flavor/store','FlavorController@store')->name('flavor.store');
        Route::post('admin/flavor/create','FlavorController@create')->name('flavor.create');
        Route::post('admin/flavor/paginate','FlavorController@getPage')->name('flavor.paginate');
        Route::post('admin/flavor/destroy','FlavorController@destroy')->name('flavor.destroy');
        Route::get('admin/flavor/index','FlavorController@index')->name('flavor.index');

        /*
         * 相簿資料維護
         * */
        Route::get('admin/album/index',['as'=>'album.index','uses'=>'AlbumController@index']);
        Route::get('admin/album/edit',['as'=>'album.edit','uses'=>'AlbumController@edit']);
        Route::post('admin/upload',['as'=>'album.upload','uses'=>'AlbumController@upload']);
        Route::post('admin/album/create',['as'=>'album.create','uses'=>'AlbumController@create']);
        Route::post('admin/DestroyAlbum',['as'=>'album.destroy_album','uses'=>'AlbumController@DestroyAlbum']);
        Route::post('admin/album/DestroyPhoto',['as'=>'album.destroy_photo','uses'=>'AlbumController@DestroyPhoto']);
//        Route::post('admin/album/paginate','AlbumController@getPage')->name('album.paginate');
        Route::get('admin/album/layer_paginate','AlbumController@getPageD')->name('album.layer_paginate');
        Route::get('admin/album/create_new',['as'=>'album.create_new','uses'=>'AlbumController@create_new']);
        Route::post('admin/album/store',['as'=>'album.store','uses'=>'AlbumController@store']);
        Route::get('admin/album/paginate/{page_num?}',['as'=>'album.paginate','uses'=>'AlbumController@paginate']);

        /*
         * 銷售資料
         * */
        Route::get('admin/sale_statistics/index',['as'=>'sale_statistics.index','uses'=>'SaleController@index']);
        Route::get('admin/sale_statistics/statistic_model',['as'=>'sale_statistics.statistic_model','uses'=>'SaleController@getStatisticModel']);


        /*
        *   表單管理
        * */
        Route::get('admin/form/index',['as'=>'form.index','uses'=>'FormManageController@index']);
        Route::get('admin/sale_statistics/statistic_model',['as'=>'sale_statistics.statistic_model','uses'=>'SaleController@getStatisticModel']);



        /*
         * 官方網站-關於就是愛
         * */
        Route::get('admin/about/index',['as'=>'about.index','uses'=>'AboutController@index']);
        Route::get('admin/about/create',['as'=>'about.create','uses'=>'AboutController@create']);
        Route::get('admin/about/edit',['as'=>'about.edit','uses'=>'AboutController@edit']);
        Route::post('admin/about/store',['as'=>'about.store','uses'=>'AboutController@store']);
        Route::post('admin/about/update',['as'=>'about.update','uses'=>'AboutController@update']);
        Route::post('admin/about/destroy',['as'=>'about.destroy','uses'=>'AboutController@destroy']);


        /*
         * 官方網站-最新消息
         * */
        Route::get('admin/news/index',['as'=>'news.index','uses'=>'FormManageController@index']);

        /*
         * 官方網站-MENU
         * */
        Route::get('admin/menu/index',['as'=>'menu.index','uses'=>'MenuController@index']);
        Route::get('admin/menu/edit',['as'=>'menu.edit','uses'=>'MenuController@edit']);
        Route::get('admin/menu/create',['as'=>'menu.create','uses'=>'MenuController@create']);
        Route::post('admin/menu/update',['as'=>'menu.update','uses'=>'MenuController@update']);
        Route::post('admin/menu/store',['as'=>'menu.store','uses'=>'MenuController@store']);
        Route::post('admin/menu/destroy',['as'=>'menu.destroy','uses'=>'MenuController@destroy']);


        /*
         * 官方網站-分店資訊
         * */
        Route::get('admin/store/index',['as'=>'store.index','uses'=>'FormManageController@index']);


        /*
         * 官方網站-與就是愛聯絡
         * */
        Route::get('admin/contact/index',['as'=>'contact.index','uses'=>'FormManageController@index']);


        /*
        *
        * 官網導覽列
        * */
        Route::get('admin/navigate/index',['as'=>'navigate.index','uses'=>'NavigateController@index']);
        Route::get('admin/navigate/create',['as'=>'navigate.create','uses'=>'NavigateController@create']);
        Route::post('admin/navigate/store',['as'=>'navigate.store','uses'=>'NavigateController@store']);
        Route::get('admin/navigate/edit/{id}',['as'=>'navigate.edit','uses'=>'NavigateController@edit']);
        Route::post('admin/navigate/destroy',['as'=>'navigate.destroy','uses'=>'NavigateController@destroy']);
        Route::post('admin/navigate/update/{id}',['as'=>'navigate.update','uses'=>'NavigateController@update']);
        Route::get('admin/navigate/status/{status}/{rules}','NavigateController@status')->name('navigate.status');

        /*
         * 官方網站-尋找就是愛
         * */
        Route::get('admin/store_info/index',['as'=>'store_info.index','uses'=>'StoreInfoController@index']);
        Route::get('admin/store_info/create',['as'=>'store_info.create','uses'=>'StoreInfoController@create']);
        Route::get('admin/store_info/edit',['as'=>'store_info.edit','uses'=>'StoreInfoController@edit']);
        Route::post('admin/store_info/store',['as'=>'store_info.store','uses'=>'StoreInfoController@store']);
        Route::post('admin/store_info/storeByAjax',['as'=>'store_info.storeByAjax','uses'=>'StoreInfoController@storeByAjax']);
        Route::get('admin/store_info/post_edit/{id}',['as'=>'store_info.post_edit','uses'=>'StoreInfoController@post_edit']);
        Route::get('admin/store_info/paginate/{page_num?}',['as'=>'store_info.paginate','uses'=>'StoreInfoController@getPage']);
        Route::post('admin/store_info/destroy',['as'=>'store_info.destroy','uses'=>'StoreInfoController@destroy']);
        Route::post('admin/store_info/update',['as'=>'store_info.update','uses'=>'StoreInfoController@update']);

        /*
        * 官方網站-消息資料維護
        * */
        Route::get('admin/news/index',['as'=>'news.index','uses'=>'NewsController@index']);
        Route::get('admin/news/edit',['as'=>'news.edit','uses'=>'NewsController@edit']);
        Route::get('admin/news/create',['as'=>'news.create','uses'=>'NewsController@create']);
        Route::post('admin/news/update',['as'=>'news.update','uses'=>'NewsController@update']);
        Route::post('admin/news/store',['as'=>'news.store','uses'=>'NewsController@store']);
        Route::post('admin/news/destroy',['as'=>'news.destroy','uses'=>'NewsController@destroy']);
        Route::get('admin/news/paginate/{page_num?}',['as'=>'news.paginate','uses'=>'NewsController@paginate']);
        Route::post('admin/news/upload',['as'=>'files.upload','uses'=>'UploadController@UploadFiles']);


        /*
        * 官方網站-輪播照片
        * */
        Route::get('admin/carousel/index',['as'=>'carousel.index','uses'=>'CarouselController@index']);
        Route::get('admin/carousel/edit',['as'=>'carousel.edit','uses'=>'CarouselController@edit']);
        Route::get('admin/carousel/create',['as'=>'carousel.create','uses'=>'CarouselController@create']);
        Route::post('admin/carousel/update',['as'=>'carousel.update','uses'=>'CarouselController@update']);
        Route::post('admin/carousel/store',['as'=>'carousel.store','uses'=>'CarouselController@store']);
        Route::post('admin/carousel/destroy',['as'=>'carousel.destroy','uses'=>'CarouselController@destroy']);
        Route::get('admin/carousel/paginate/{page_num?}',['as'=>'carousel.paginate','uses'=>'CarouselController@paginate']);


    });



});
