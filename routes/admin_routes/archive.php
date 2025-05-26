<?php

/* * ******  CLUB Field Start ********** */
Route::get('list-archives', array_merge(['uses' => 'Admin\ArchiveController@indexArchive']))->name('list.archives');
Route::get('create-archive', array_merge(['uses' => 'Admin\ArchiveController@createArchive']))->name('create.archive');
Route::post('store-archive', array_merge(['uses' => 'Admin\ArchiveController@storeArchive']))->name('store.archive');
Route::get('edit-archive/{id}', array_merge(['uses' => 'Admin\ArchiveController@editArchive']))->name('archive.edit');
Route::put('update-archive/{id}', array_merge(['uses' => 'Admin\ArchiveController@updateArchive']))->name('update.archive');
Route::get('archive-download/{id}', array_merge(['uses' => 'Admin\ArchiveController@downloadArchive']))->name('archive.download');
Route::delete('delete-archive', array_merge(['uses' => 'Admin\ArchiveController@deleteArchive']))->name('delete.archive');
Route::put('make-not-active-archive', array_merge(['uses' => 'Admin\ArchiveController@makeNotActiveArchive']))->name('make.not.active.archive');
Route::put('make-active-archive', array_merge(['uses' => 'Admin\ArchiveController@makeActiveArchive']))->name('make.active.archive');
Route::get('sort-archive', array_merge(['uses' => 'Admin\ArchiveController@sortArchive']))->name('sort.archives');
Route::get('archive-sort-data', array_merge(['uses' => 'Admin\ArchiveController@archiveSortData']))->name('archive.sort.data');
Route::put('archive-sort-update', array_merge(['uses' => 'Admin\ArchiveController@archiveSortUpdate']))->name('archive.sort.update');

Route::get('multiple-attach-for-archive', array_merge(['uses' => 'Admin\ArchiveController@archiveMultipleAttachment']))->name('multiple_attach_for_archive');
Route::get('delete-archive-attachment/{id}', array_merge(['uses' => 'Admin\ArchiveController@archiveMultipleAttachmentDelete']))->name('delete_archive_attachment');
Route::get('archive_multiple_download/{id}', array_merge(['uses' => 'Admin\ArchiveController@downloadArchiveMultiple']))->name('archive_multiple_download');

/* * ****** End CLUB Field ********** */
?>