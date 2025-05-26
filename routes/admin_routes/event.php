<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-events', array_merge(['uses' => 'Admin\EventController@indexEvents']))->name('list.events');
Route::get('create-event', array_merge(['uses' => 'Admin\EventController@createEvent']))->name('create.event');
Route::post('store-event', array_merge(['uses' => 'Admin\EventController@storeEvent']))->name('store.event');
Route::get('edit-event/{id}', array_merge(['uses' => 'Admin\EventController@editEvent']))->name('event.edit');
Route::put('update-event/{id}', array_merge(['uses' => 'Admin\EventController@updateEvent']))->name('update.event');
Route::get('match-schedule-download/{id}', array_merge(['uses' => 'Admin\EventController@downloadMatchSchedule']))->name('match.schedule.download');
Route::delete('delete-event', array_merge(['uses' => 'Admin\EventController@deleteEvent']))->name('delete.event');
Route::put('make-not-active-event', array_merge(['uses' => 'Admin\EventController@makeNotActiveEvent']))->name('make.not.active.event');
Route::put('make-active-event', array_merge(['uses' => 'Admin\EventController@makeActiveEvent']))->name('make.active.event');
Route::get('sort-event', array_merge(['uses' => 'Admin\EventController@sortEvents']))->name('sort.events');
Route::get('event-sort-data', array_merge(['uses' => 'Admin\EventController@eventSortData']))->name('event.sort.data');
Route::put('event-sort-update', array_merge(['uses' => 'Admin\EventController@eventSortUpdate']))->name('event.sort.update');
Route::get('get-event-name', array_merge(['uses' => 'Admin\EventController@getEventName']))->name('get_event_name');
/* * ****** End CLUB Field ********** */
?>