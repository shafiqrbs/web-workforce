<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin/photo-gallery')->group(function() {
//    Route::get('/', 'PhotoGalleryController@index');
    Route::get('/list', array_merge(['uses' => 'PhotoGalleryController@index']))->name('list.gallery');
    Route::get('/create', array_merge(['uses' => 'PhotoGalleryController@create']))->name('create.gallery');
    Route::post('/store', array_merge(['uses' => 'PhotoGalleryController@store']))->name('store.gallery');
    Route::post('/store', array_merge(['uses' => 'PhotoGalleryController@store']))->name('store.gallery');
    Route::get('/edit/{id}', array_merge(['uses' => 'PhotoGalleryController@edit']))->name('edit.gallery');
    Route::put('/update/{id}', array_merge(['uses' => 'PhotoGalleryController@update']))->name('update.gallery');
    Route::get('fetch-galleries', array_merge(['uses' => 'PhotoGalleryController@fetchGalleriesData']))->name('fetch.data.gallery');
    Route::get('/delete/{id}', array_merge(['uses' => 'PhotoGalleryController@destroy']))->name('delete.gallery');

    Route::post('/photo-gallery-image-store', array_merge(['uses' => 'PhotoGalleryController@storePhotoGalleryImage']))->name('store_photo_gallery_image');
    Route::get('/ajax/photo-gallery-image/delete/{id}' ,'PhotoGalleryController@deletePhotoGalleryImage')->name('delete_photo_gallery_image');


    Route::put('make-not-active-gallery', array_merge(['uses' => 'PhotoGalleryController@makeNotActiveGallery']))->name('make_not_active_gallery');
    Route::put('make-active-gallery', array_merge(['uses' => 'PhotoGalleryController@makeActiveGallery']))->name('make_active_gallery');



    Route::get('sort-gallery', array_merge(['uses' => 'PhotoGalleryController@sortGallery']))->name('sort_gallery');
    Route::get('sort-photo/{id}', array_merge(['uses' => 'PhotoGalleryController@sortPhoto']))->name('sort_photo');
    Route::put('gallery-sort-update', array_merge(['uses' => 'PhotoGalleryController@gallerySortUpdate']))->name('gallery_sort_update');
    Route::put('photo-sort-update', array_merge(['uses' => 'PhotoGalleryController@photoSortUpdate']))->name('photo_sort_update');

});
