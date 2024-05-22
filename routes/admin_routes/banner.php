<?php

/* * ******  Banner Route Start ********** */
Route::get('list-banners', array_merge(['uses' => 'Admin\BannerController@indexBanner'], $sup_only))->name('list.banners');
Route::get('create-banner', array_merge(['uses' => 'Admin\BannerController@createBanner'], $sup_only))->name('create.banner');
Route::post('store-banner', array_merge(['uses' => 'Admin\BannerController@storeBanner'], $sup_only))->name('store.banner');
Route::get('edit-banner/{id}', array_merge(['uses' => 'Admin\BannerController@editBanner'], $sup_only))->name('banner.edit');
Route::put('update-banner/{id}', array_merge(['uses' => 'Admin\BannerController@updateBanner'], $sup_only))->name('update.banner');
Route::delete('delete-banner', array_merge(['uses' => 'Admin\BannerController@deleteBanner'], $sup_only))->name('delete.banner');
Route::put('make-not-active-banner', array_merge(['uses' => 'Admin\BannerController@makeNotActiveBanner'], $sup_only))->name('make.not.active.banner');
Route::put('make-active-banner', array_merge(['uses' => 'Admin\BannerController@makeActiveBanner'], $sup_only))->name('make.active.banner');
/* * ****** End Banner Route ********** */
?>