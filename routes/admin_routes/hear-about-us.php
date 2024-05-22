<?php

/* * ******  Gender Start ********** */
Route::get('list-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@indexHearAboutUs'], $all_users))->name('list.hearUs');
Route::get('create-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@createHearAboutUs'], $all_users))->name('create.hearUs');
Route::post('store-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@storeHearAboutUs'], $all_users))->name('store.hearUs');
Route::get('edit-hear-us/{id}', array_merge(['uses' => 'Admin\HearAboutUsController@editHearAboutUs'], $all_users))->name('edit.hearUs');
Route::put('update-hear-us/{id}', array_merge(['uses' => 'Admin\HearAboutUsController@updateHearAboutUs'], $all_users))->name('update.hearUs');
Route::delete('delete-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@deleteHearAboutUs'], $all_users))->name('delete.hearUs');
Route::get('fetch-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@fetchHearAboutUsData'], $all_users))->name('fetch.data.hearUs');
Route::put('make-active-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@makeActiveHearAboutUs'], $all_users))->name('make.active.hearUs');
Route::put('make-not-active-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@makeNotActiveHearAboutUs'], $all_users))->name('make.not.active.hearUs');
Route::get('sort-hear-us', array_merge(['uses' => 'Admin\HearAboutUsController@sortHearAboutUs'], $all_users))->name('sort.hearUs');
Route::get('hear-us-sort-data', array_merge(['uses' => 'Admin\HearAboutUsController@hearAboutUsSortData'], $all_users))->name('hearUs.sort.data');
Route::put('hear-us-sort-update', array_merge(['uses' => 'Admin\HearAboutUsController@hearAboutUsSortUpdate'], $all_users))->name('hearUs.sort.update');
/* * ****** End Gender ********** */