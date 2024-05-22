<?php

/* * ******  News & Notice Category Field Start ********** */
Route::get('news-notice/list', array_merge(['uses' => 'Admin\NewsAndNoticeController@index'], $sup_only))->name('list.news.notice');
Route::get('news-notice/create', array_merge(['uses' => 'Admin\NewsAndNoticeController@create'], $sup_only))->name('create.news.notice');
Route::post('news-notice/store', array_merge(['uses' => 'Admin\NewsAndNoticeController@store'], $sup_only))->name('store.news.notice');
Route::get('news-notice/edit/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@edit'], $sup_only))->name('edit.news.notice');
Route::post('news-notice/update/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@update'], $sup_only))->name('update.news.notice');
Route::delete('news-notice/delete', array_merge(['uses' => 'Admin\NewsAndNoticeController@destroy'], $sup_only))->name('delete.news.notice');
Route::get('news-notice/find/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@get_news_notice_by_id'], $sup_only))->name('find.news.notice');
Route::get('news-notice/remove_feature_image/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeController@remove_feature_image'], $sup_only))->name('remove.news.notice.image');


Route::put('make-not-active-news', array_merge(['uses' => 'Admin\NewsAndNoticeController@makeNotActiveNews'], $sup_only))->name('make.not.active.news');
Route::put('make-active-news', array_merge(['uses' => 'Admin\NewsAndNoticeController@makeActiveNews'], $sup_only))->name('make.active.news');
Route::get('sort-news', array_merge(['uses' => 'Admin\NewsAndNoticeController@sortNews'], $sup_only))->name('sort.news');
Route::get('news-sort-data', array_merge(['uses' => 'Admin\NewsAndNoticeController@newsSortData'], $sup_only))->name('news.sort.data');
Route::put('news-sort-update', array_merge(['uses' => 'Admin\NewsAndNoticeController@newsSortUpdate'], $sup_only))->name('news.sort.update');

/* * ****** End News & Notice Category Field ********** */
?>