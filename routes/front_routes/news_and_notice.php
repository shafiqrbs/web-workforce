<?php

Route::get('news-and-notice/news', 'NewsController@index')->name('news.list');
Route::get('news-and-notice/news/details/{id}', 'NewsController@newsDetails')->name('news.details');
Route::get('news-and-notice/notice', 'NoticeController@index')->name('notice.list');
Route::get('news-and-notice/notice/details/{id}', 'NoticeController@noticeDetails')->name('notice.details');
