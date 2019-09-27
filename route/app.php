<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

Route::any('timestamp', 'index/timestamp')->name('timestamp');
Route::any('shorturl', 'index/shorturl')->name('shorturl');
Route::any('md5', 'index/md5')->name('md5');
Route::any('age', 'index/age')->name('age');
Route::any('age-:year-:month-:day-:hour', 'index/age')->name('age');
