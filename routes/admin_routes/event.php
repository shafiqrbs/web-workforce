<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-events', array_merge(['uses' => 'Admin\EventController@indexEvents'], $sup_only))->name('list.events');
Route::get('create-event', array_merge(['uses' => 'Admin\EventController@createEvent'], $sup_only))->name('create.event');
Route::post('store-event', array_merge(['uses' => 'Admin\EventController@storeEvent'], $sup_only))->name('store.event');
Route::get('edit-event/{id}', array_merge(['uses' => 'Admin\EventController@editEvent'], $sup_only))->name('event.edit');
Route::put('update-event/{id}', array_merge(['uses' => 'Admin\EventController@updateEvent'], $sup_only))->name('update.event');
Route::get('match-schedule-download/{id}', array_merge(['uses' => 'Admin\EventController@downloadMatchSchedule'], $sup_only))->name('match.schedule.download');
Route::delete('delete-event', array_merge(['uses' => 'Admin\EventController@deleteEvent'], $sup_only))->name('delete.event');
Route::put('make-not-active-event', array_merge(['uses' => 'Admin\EventController@makeNotActiveEvent'], $sup_only))->name('make.not.active.event');
Route::put('make-active-event', array_merge(['uses' => 'Admin\EventController@makeActiveEvent'], $sup_only))->name('make.active.event');
Route::get('sort-event', array_merge(['uses' => 'Admin\EventController@sortEvents'], $sup_only))->name('sort.events');
Route::get('event-sort-data', array_merge(['uses' => 'Admin\EventController@eventSortData'], $sup_only))->name('event.sort.data');
Route::put('event-sort-update', array_merge(['uses' => 'Admin\EventController@eventSortUpdate'], $sup_only))->name('event.sort.update');
Route::get('get-event-name', array_merge(['uses' => 'Admin\EventController@getEventName'], $sup_only))->name('get_event_name');
/* * ****** End CLUB Field ********** */
?>