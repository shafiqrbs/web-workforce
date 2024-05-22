<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-event-type', array_merge(['uses' => 'Admin\EventTypeController@indexEventType'], $sup_only))->name('list_event_type');
Route::get('create-event-type', array_merge(['uses' => 'Admin\EventTypeController@createEventType'], $sup_only))->name('create_event_type');
Route::post('store-event-type', array_merge(['uses' => 'Admin\EventTypeController@storeEventType'], $sup_only))->name('store_event_type');
Route::get('edit-event-type/{id}', array_merge(['uses' => 'Admin\EventTypeController@editEventType'], $sup_only))->name('event_type_edit');
Route::put('update-event-type/{id}', array_merge(['uses' => 'Admin\EventTypeController@updateEventType'], $sup_only))->name('update_event_type');
Route::delete('delete-event-type', array_merge(['uses' => 'Admin\EventTypeController@deleteEventType'], $sup_only))->name('delete_event_type');
Route::put('make-not-active-event-type', array_merge(['uses' => 'Admin\EventTypeController@makeNotActiveEventType'], $sup_only))->name('make_not_active_event_type');
Route::put('make-active-event-type', array_merge(['uses' => 'Admin\EventTypeController@makeActiveEventType'], $sup_only))->name('make_active_event_type');


/*Route::get('sort-event-type', array_merge(['uses' => 'Admin\EventTypeController@sortEventType'], $sup_only))->name('sort_event_types');
Route::get('event-type-sort-data', array_merge(['uses' => 'Admin\EventTypeController@EventTypeSortData'], $sup_only))->name('event_type_sort_data');
Route::put('event-type-sort-update', array_merge(['uses' => 'Admin\EventTypeController@EventTypeSortUpdate'], $sup_only))->name('event_type_sort_update');*/
/* * ****** End CLUB Field ********** */
?>