<?php
Route::get('club/find', 'ClubController@index')->name('club_find');
Route::get('club/details/{id}', 'ClubController@clubDetails')->name('club_details');
