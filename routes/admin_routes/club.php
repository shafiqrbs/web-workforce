<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-clubs', array_merge(['uses' => 'Admin\ShootingSportClubController@indexClubs'], $sup_only))->name('list.clubs');
Route::get('create-club', array_merge(['uses' => 'Admin\ShootingSportClubController@createClub'], $sup_only))->name('create.club');
Route::post('store-club', array_merge(['uses' => 'Admin\ShootingSportClubController@storeClub'], $sup_only))->name('store.club');
Route::get('edit-club/{id}/{industry_id?}', array_merge(['uses' => 'Admin\ShootingSportClubController@editClub'], $sup_only))->name('edit.club');
Route::put('update-club/{id}', array_merge(['uses' => 'Admin\ShootingSportClubController@updateClub'], $sup_only))->name('update.club');
Route::delete('delete-club', array_merge(['uses' => 'Admin\ShootingSportClubController@deleteClub'], $sup_only))->name('delete.club');
Route::get('fetch-clubs', array_merge(['uses' => 'Admin\ShootingSportClubController@fetchClubsData'], $sup_only))->name('fetch.data.clubs');
Route::get('sort-club', array_merge(['uses' => 'Admin\ShootingSportClubController@sortClubs'], $sup_only))->name('sort.clubs');
Route::get('club-sort-data', array_merge(['uses' => 'Admin\ShootingSportClubController@clubSortData'], $sup_only))->name('club.sort.data');
Route::put('club-sort-update', array_merge(['uses' => 'Admin\ShootingSportClubController@clubSortUpdate'], $sup_only))->name('club.sort.update');

Route::put('make-not-active-club', array_merge(['uses' => 'Admin\ShootingSportClubController@makeNotActiveClub'], $sup_only))->name('make.not.active.club');
Route::put('make-active-club', array_merge(['uses' => 'Admin\ShootingSportClubController@makeActiveClub'], $sup_only))->name('make.active.club');


Route::get('district-dropdown-route', array_merge(['uses' => 'Admin\ShootingSportClubController@findDistrict'], $sup_only))->name('district_dropdown_route');

/* * ****** End CLUB Field ********** */
?>