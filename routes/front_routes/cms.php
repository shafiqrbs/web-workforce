<?php
Route::get('cms/{slug}', 'CmsController@getPage')->name('cms');
Route::get('about-us', 'CmsController@cmsAboiutUs')->name('cms.about.us');
Route::get('achievement-list', 'CmsController@cmsAchievement')->name('cms.achievement.list');
Route::get('case-story-list', 'CmsController@cmsCaseStory')->name('cms.case-story');
Route::get('event/details/{id}', 'CmsController@cmsEventDetails')->name('event_details');
Route::get('event-list', 'CmsController@cmsEvent')->name('cms.events');
Route::get('news/details/{id}', 'CmsController@cmsNewsDetails')->name('news_details');
Route::get('news-list', 'CmsController@cmsNews')->name('cms.news');
Route::get('resources-list', 'CmsController@cmsResources')->name('cms.resources');
Route::get('contact-us', 'ContactController@index')->name('cms.contact.us');
Route::get('contact-us-thanks', 'ContactController@thanks')->name('contact.us.thanks');
