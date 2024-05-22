<?php

Route::get('photo-gallery', 'PhotoGalleryController@index')->name('photo_gallery');
Route::get('photo-gallery-year/{year}', 'PhotoGalleryController@indexYear')->name('photo_gallery_year');
Route::get('photo-gallery/details/{id}', 'PhotoGalleryController@galleryDetails')->name('gallery_details');
