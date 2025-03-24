<?php


Route::get('cms/{slug}', 'CmsController@getPage')->name('cms');
Route::get('about-us', 'CmsController@cmsAboiutUs')->name('cms.about.us');
Route::get('achievement', 'CmsController@cmsAchievement')->name('cms.achievement');
Route::get('case-story', 'CmsController@cmsCaseStory')->name('cms.case-story');
Route::get('event/details/{id}', 'CmsController@cmsEventDetails')->name('event_details');
Route::get('event-list', 'CmsController@cmsEvent')->name('cms.events');
Route::get('news', 'CmsController@cmsNews')->name('cms.news');
Route::get('resources', 'CmsController@cmsResource')->name('cms.resources');
Route::get('contact-us', 'ContactController@index')->name('cms.contact.us');
Route::post('contact-us', 'ContactController@postContact')->name('contact.us');
Route::get('contact-us-thanks', 'ContactController@thanks')->name('contact.us.thanks');
