<?php

/* * ******  News & Notice Category Field Start ********** */
Route::get('list-news-notice-category', array_merge(['uses' => 'Admin\NewsAndNoticeCategoryController@index'], $sup_only))->name('list.news.notice.category');
Route::post('news-notice-category/create', array_merge(['uses' => 'Admin\NewsAndNoticeCategoryController@create'], $sup_only))->name('create.news.notice.category');
Route::post('news-notice-category/update', array_merge(['uses' => 'Admin\NewsAndNoticeCategoryController@update'], $sup_only))->name('update.news.notice.category');
Route::delete('news-notice-category/delete/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeCategoryController@destroy'], $sup_only))->name('delete.news.notice.category');
Route::get('news-notice-category/find/{id}', array_merge(['uses' => 'Admin\NewsAndNoticeCategoryController@get_news_notice_category_by_id'], $sup_only))->name('find.news.notice.category');
/* * ****** End News & Notice Category Field ********** */
?>