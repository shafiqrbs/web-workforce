<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-professions', array_merge(['uses' => 'Admin\ProfessionController@indexProfession'], $sup_only))->name('list.professions');
Route::get('create-profession', array_merge(['uses' => 'Admin\ProfessionController@createProfession'], $sup_only))->name('create.profession');
Route::post('store-profession', array_merge(['uses' => 'Admin\ProfessionController@storeProfession'], $sup_only))->name('store.profession');
Route::get('edit-profession/{id}', array_merge(['uses' => 'Admin\ProfessionController@editProfession'], $sup_only))->name('profession.edit');
Route::put('update-profession/{id}', array_merge(['uses' => 'Admin\ProfessionController@updateProfession'], $sup_only))->name('update.profession');
Route::get('profession-download/{id}', array_merge(['uses' => 'Admin\ProfessionController@downloadProfession'], $sup_only))->name('profession.download');
Route::delete('delete-profession', array_merge(['uses' => 'Admin\ProfessionController@deleteProfession'], $sup_only))->name('delete.profession');
Route::put('make-not-active-profession', array_merge(['uses' => 'Admin\ProfessionController@makeNotActiveProfession'], $sup_only))->name('make.not.active.profession');
Route::put('make-active-profession', array_merge(['uses' => 'Admin\ProfessionController@makeActiveProfession'], $sup_only))->name('make.active.profession');
Route::get('sort-profession', array_merge(['uses' => 'Admin\ProfessionController@sortProfession'], $sup_only))->name('sort.professions');
Route::get('profession-sort-data', array_merge(['uses' => 'Admin\ProfessionController@professionSortData'], $sup_only))->name('profession.sort.data');
Route::put('profession-sort-update', array_merge(['uses' => 'Admin\ProfessionController@professionSortUpdate'], $sup_only))->name('profession.sort.update');
/* * ****** End CLUB Field ********** */
?>