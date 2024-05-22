<?php
Route::get('events', 'EventController@eventIndex')->name('event_index');
Route::get('event/details/{id}', 'EventController@eventDetails')->name('event_details');
Route::get('event/calendar', 'EventController@eventCalender')->name('event_calender');
Route::get('event/calendar/filter', 'EventController@eventCalenderFilter')->name('event_calender_filter');
Route::get('match-schedule-download-front/{id}', 'EventController@downloadMatchScheduleFront')->name('match_schedule_download_front');

