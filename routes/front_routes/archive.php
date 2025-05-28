<?php
Route::get('archives', 'ArchiveController@ArchiveIndex')->name('archive_index');
Route::get('archives/search', 'ArchiveController@ArchiveSearch')->name('archive_search');
//Route::get('archive/search', 'ArchiveController@ArchiveSearch')->name('archive_search');

Route::get('programs', 'ArchiveController@ProgramsIndex')->name('programs_index');

Route::get('archives/download/user/{id}','ArchiveController@ArchiveDownloadUser')->name('archive_download_user');
Route::get('archive-multiple-attachment','ArchiveController@ArchiveMultipleAttachment')->name('get_archive_multiple_attachment');
Route::get('archive-multiple-download-front/{id}','ArchiveController@ArchiveMultipleAttachmentDownload')->name('archive_multiple_download_front');
