<?php

/* * ******  Slider Start ********** */
Route::get('list-sliders', array_merge(['uses' => 'Admin\SliderController@indexSliders'], $sup_only))->name('list.sliders');
Route::get('create-slider', array_merge(['uses' => 'Admin\SliderController@createSlider'], $sup_only))->name('create.slider');
Route::post('store-slider', array_merge(['uses' => 'Admin\SliderController@storeSlider'], $sup_only))->name('store.slider');
Route::get('edit-slider/{id}', array_merge(['uses' => 'Admin\SliderController@editSlider'], $sup_only))->name('edit.slider');
Route::put('update-slider/{id}', array_merge(['uses' => 'Admin\SliderController@updateSlider'], $sup_only))->name('update.slider');
Route::delete('delete-slider', array_merge(['uses' => 'Admin\SliderController@deleteSlider'], $sup_only))->name('delete.slider');
Route::get('fetch-sliders', array_merge(['uses' => 'Admin\SliderController@fetchSlidersData'], $sup_only))->name('fetch.data.sliders');
Route::put('make-active-slider', array_merge(['uses' => 'Admin\SliderController@makeActiveSlider'], $sup_only))->name('make.active.slider');
Route::put('make-not-active-slider', array_merge(['uses' => 'Admin\SliderController@makeNotActiveSlider'], $sup_only))->name('make.not.active.slider');
Route::get('sort-sliders', array_merge(['uses' => 'Admin\SliderController@sortSliders'], $sup_only))->name('sort.sliders');
Route::get('slider-sort-data', array_merge(['uses' => 'Admin\SliderController@sliderSortData'], $sup_only))->name('slider.sort.data');
Route::put('slider-sort-update', array_merge(['uses' => 'Admin\SliderController@sliderSortUpdate'], $sup_only))->name('slider.sort.update');
/* * ****** End Slider ********** */