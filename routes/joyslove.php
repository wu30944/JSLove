<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/3/12
 * Time: 下午11:57
 */
Route::get ( '/', ['as' => 'joyslove.index','uses' => 'IndexController@index']);

Route::post('/submit/contactus',['as'=>'joyslove.submit','uses'=>'IndexController@store']);

