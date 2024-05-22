<?php

Route::get('list-jury', array_merge(['uses' => 'Admin\JuryController@indexJurys'], $sup_only))->name('list_jury');
Route::get('create-jury', array_merge(['uses' => 'Admin\JuryController@createJury'], $sup_only))->name('create_jury');
Route::post('store-jury', array_merge(['uses' => 'Admin\JuryController@storeJury'], $sup_only))->name('store_jury');
Route::get('edit-jury/{id}', array_merge(['uses' => 'Admin\JuryController@editJury'], $sup_only))->name('edit_jury');
Route::put('update-jury/{id}', array_merge(['uses' => 'Admin\JuryController@updateJury'], $sup_only))->name('update_jury');
Route::delete('delete-jury', array_merge(['uses' => 'Admin\JuryController@deleteJury'], $sup_only))->name('delete_jury');
Route::put('make-not-active-jury', array_merge(['uses' => 'Admin\JuryController@makeNotActiveJury'], $sup_only))->name('make_inactive_jury');
Route::put('make-active-jury', array_merge(['uses' => 'Admin\JuryController@makeActiveJury'], $sup_only))->name('make_active_jury');

Route::get('sort-jury', array_merge(['uses' => 'Admin\JuryController@sortJury'], $sup_only))->name('sort_jury');
Route::put('jury-sort-update', array_merge(['uses' => 'Admin\JuryController@jurySortUpdate'], $sup_only))->name('jury_sort_update');
