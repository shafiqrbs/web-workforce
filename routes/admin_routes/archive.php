<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-archives', array_merge(['uses' => 'Admin\ArchiveController@indexArchive'], $sup_only))->name('list.archives');
Route::get('create-archive', array_merge(['uses' => 'Admin\ArchiveController@createArchive'], $sup_only))->name('create.archive');
Route::post('store-archive', array_merge(['uses' => 'Admin\ArchiveController@storeArchive'], $sup_only))->name('store.archive');
Route::get('edit-archive/{id}', array_merge(['uses' => 'Admin\ArchiveController@editArchive'], $sup_only))->name('archive.edit');
Route::put('update-archive/{id}', array_merge(['uses' => 'Admin\ArchiveController@updateArchive'], $sup_only))->name('update.archive');
Route::get('archive-download/{id}', array_merge(['uses' => 'Admin\ArchiveController@downloadArchive'], $sup_only))->name('archive.download');
Route::delete('delete-archive', array_merge(['uses' => 'Admin\ArchiveController@deleteArchive'], $sup_only))->name('delete.archive');
Route::put('make-not-active-archive', array_merge(['uses' => 'Admin\ArchiveController@makeNotActiveArchive'], $sup_only))->name('make.not.active.archive');
Route::put('make-active-archive', array_merge(['uses' => 'Admin\ArchiveController@makeActiveArchive'], $sup_only))->name('make.active.archive');
Route::get('sort-archive', array_merge(['uses' => 'Admin\ArchiveController@sortArchive'], $sup_only))->name('sort.archives');
Route::get('archive-sort-data', array_merge(['uses' => 'Admin\ArchiveController@archiveSortData'], $sup_only))->name('archive.sort.data');
Route::put('archive-sort-update', array_merge(['uses' => 'Admin\ArchiveController@archiveSortUpdate'], $sup_only))->name('archive.sort.update');

Route::get('multiple-attach-for-archive', array_merge(['uses' => 'Admin\ArchiveController@archiveMultipleAttachment'], $sup_only))->name('multiple_attach_for_archive');
Route::get('delete-archive-attachment/{id}', array_merge(['uses' => 'Admin\ArchiveController@archiveMultipleAttachmentDelete'], $sup_only))->name('delete_archive_attachment');
Route::get('archive_multiple_download/{id}', array_merge(['uses' => 'Admin\ArchiveController@downloadArchiveMultiple'], $sup_only))->name('archive_multiple_download');

/* * ****** End CLUB Field ********** */
?>