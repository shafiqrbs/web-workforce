<?php
Route::get('athlete/{type}', 'AthleteController@athleteIndex')->name('athlete');
Route::get('athlete/details/{id}', 'AthleteController@athleteDetails')->name('athlete_details');
