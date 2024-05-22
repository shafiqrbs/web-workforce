<?php

/* * ******  CMS Field Start ********** */
/*Route::get('list-cms', array_merge(['uses' => 'Admin\CmsController@indexCms'], $sup_only))->name('list.cms');
Route::get('create-cms', array_merge(['uses' => 'Admin\CmsController@createCms'], $sup_only))->name('create.cms');
Route::post('store-cms', array_merge(['uses' => 'Admin\CmsController@storeCms'], $sup_only))->name('store.cms');
Route::get('edit-cms/{id}/{industry_id?}', array_merge(['uses' => 'Admin\CmsController@editCms'], $sup_only))->name('edit.cms');
Route::put('update-cms/{id}', array_merge(['uses' => 'Admin\CmsController@updateCms'], $sup_only))->name('update.cms');
Route::delete('delete-cms', array_merge(['uses' => 'Admin\CmsController@deleteCms'], $sup_only))->name('delete.cms');
Route::get('fetch-cms', array_merge(['uses' => 'Admin\CmsController@fetchCmsData'], $sup_only))->name('fetch.data.cms');*/
/* * ****** End CMS Field ********** */
/* * ******  CmsContent Field Start ********** */
Route::get('list-cmsContent', array_merge(['uses' => 'Admin\CmsContentController@indexCmsContent'], $sup_only))->name('list.cmsContent');
Route::get('create-cmsContent', array_merge(['uses' => 'Admin\CmsContentController@createCmsContent'], $sup_only))->name('create.cmsContent');
Route::post('store-cmsContent', array_merge(['uses' => 'Admin\CmsContentController@storeCmsContent'], $sup_only))->name('store.cmsContent');
Route::get('edit-cmsContent/{id}/{industry_id?}', array_merge(['uses' => 'Admin\CmsContentController@editCmsContent'], $sup_only))->name('edit.cmsContent');
Route::put('update-cmsContent/{id}', array_merge(['uses' => 'Admin\CmsContentController@updateCmsContent'], $sup_only))->name('update.cmsContent');
Route::delete('delete-cmsContent', array_merge(['uses' => 'Admin\CmsContentController@deleteCmsContent'], $sup_only))->name('delete.cmsContent');
Route::get('fetch-cmsContent', array_merge(['uses' => 'Admin\CmsContentController@fetchCmsContentData'], $sup_only))->name('fetch.data.cmsContent');

Route::get('sort-cms', array_merge(['uses' => 'Admin\CmsController@sortCms'], $sup_only))->name('sort.cms');
Route::get('cms-sort-data', array_merge(['uses' => 'Admin\CmsController@cmsSortData'], $sup_only))->name('cms.sort.data');
Route::put('cms-sort-update', array_merge(['uses' => 'Admin\CmsController@cmsSortUpdate'], $sup_only))->name('cms.sort.update');

Route::put('make-not-active-cms', array_merge(['uses' => 'Admin\CmsContentController@makeNotActiveCms'], $sup_only))->name('make.not.active.cms');
Route::put('make-active-cms', array_merge(['uses' => 'Admin\CmsContentController@makeActiveCms'], $sup_only))->name('make.active.cms');

/* * ****** End CmsContent Field ********** */
?>