<?php

/* * ******  Admin User Start ********** */
Route::get('list-admin-users', array_merge(['uses' => 'Admin\AdminController@indexAdminUsers']))->name('list.admin.users');
Route::get('create-admin-user', array_merge(['uses' => 'Admin\AdminController@createAdminUser']))->name('create.admin.user');
Route::post('store-admin-user', array_merge(['uses' => 'Admin\AdminController@storeAdminUser']))->name('store.admin.user');
Route::get('edit-admin-user/{id}', array_merge(['uses' => 'Admin\AdminController@editAdminUser']))->name('edit.admin.user');
Route::put('update-admin-user/{id}', array_merge(['uses' => 'Admin\AdminController@updateAdminUser']))->name('update.admin.user');
Route::delete('delete-admin-user', array_merge(['uses' => 'Admin\AdminController@deleteAdminUser']))->name('delete.admin.user');
Route::get('fetch-admin-users', array_merge(['uses' => 'Admin\AdminController@fetchAdminUsersData']))->name('fetch.data.admin.users');
/* * ****** End Admin User ********** */
?>