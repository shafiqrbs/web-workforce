<?php


Route::get('arms-view','ArmsController@index')->name('arms');
Route::get('arms-view/details/{id}', 'ArmsController@ArmsDetails')->name('arms_details');
