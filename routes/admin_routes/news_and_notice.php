<?php

/* * ******  News & Notice Category Field Start ********** */
Route::get('news-notice/list', array_merge(['uses' => 'Admin\NewsAndNoticeController@index']))->name('list.news.notice');
Route::get('news-notice/create', array_merge(['uses' => 'Admin\NewsAndNoticeController@create']))->name('create.news.notice');
Route::post('news-notice/store', array_merge(['uses' => 'Admin\NewsAndNoticeController@store']))->name('store.news.notice');
Route::get('news-notice/edit/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@edit']))->name('edit.news.notice');
Route::post('news-notice/update/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@update']))->name('update.news.notice');
Route::delete('news-notice/delete', array_merge(['uses' => 'Admin\NewsAndNoticeController@destroy']))->name('delete.news.notice');
Route::get('news-notice/find/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@get_news_notice_by_id']))->name('find.news.notice');
Route::get('news-notice/remove_feature_image/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@remove_feature_image']))->name('remove.news.notice.image');


Route::put('make-not-active-news', array_merge(['uses' => 'Admin\NewsAndNoticeController@makeNotActiveNews']))->name('make.not.active.news');
Route::put('make-active-news', array_merge(['uses' => 'Admin\NewsAndNoticeController@makeActiveNews']))->name('make.active.news');
Route::get('sort-news', array_merge(['uses' => 'Admin\NewsAndNoticeController@sortNews']))->name('sort.news');
Route::get('news-sort-data', array_merge(['uses' => 'Admin\NewsAndNoticeController@newsSortData']))->name('news.sort.data');
Route::put('news-sort-update', array_merge(['uses' => 'Admin\NewsAndNoticeController@newsSortUpdate']))->name('news.sort.update');

/* * ****** End News & Notice Category Field ********** */
?>