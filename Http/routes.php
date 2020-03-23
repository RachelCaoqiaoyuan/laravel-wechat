<?php
Route::any('/','WeChatController@index')->middleware('swechat.check');
Route::get('hellooo',function (){
    return view('swechat::welcome');
});
Route::get('wechat-check', function (){
    return 'ui';
})->middleware('swechat.check');