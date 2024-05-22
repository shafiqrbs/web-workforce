<?php

/* * ******  Member Field Start ********** */
Route::get('list-arms', array_merge(['uses' => 'Admin\ArmsController@indexArms'], $sup_only))->name('list_arms');
Route::get('create-arms', array_merge(['uses' => 'Admin\ArmsController@createArms'], $sup_only))->name('create_arms');
Route::post('store-arms', array_merge(['uses' => 'Admin\ArmsController@storeArms'], $sup_only))->name('store_arms');
Route::get('edit-arms/{id}', array_merge(['uses' => 'Admin\ArmsController@editArms'], $sup_only))->name('edit_arms');
Route::put('update-arms/{id}', array_merge(['uses' => 'Admin\ArmsController@updateArms'], $sup_only))->name('update_arms');
Route::delete('delete-arms', array_merge(['uses' => 'Admin\ArmsController@deleteArms'], $sup_only))->name('delete_arms');
Route::put('make-not-active-arms', array_merge(['uses' => 'Admin\ArmsController@makeNotActiveArms'], $sup_only))->name('make_inactive_arms');
Route::put('make-active-arms', array_merge(['uses' => 'Admin\ArmsController@makeActiveArms'], $sup_only))->name('make_active_arms');
/* * ****** Member Field ********** */


Route::get('sort-arms', array_merge(['uses' => 'Admin\ArmsController@sortArms'], $sup_only))->name('sort_arms');
Route::put('arms-sort-update', array_merge(['uses' => 'Admin\ArmsController@ArmsSortUpdate'], $sup_only))->name('arms_sort_update');
