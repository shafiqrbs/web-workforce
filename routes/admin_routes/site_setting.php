<?php

/* * ******  SiteSetting Start ********** */
Route::get('edit-site-setting', array_merge(['uses' => 'Admin\SiteSettingController@editsiteSetting'], $sup_only))->name('edit.site.setting');
Route::put('update-site-setting', array_merge(['uses' => 'Admin\SiteSettingController@updatesiteSetting'], $sup_only))->name('update.site.setting');
/* * ****** End SiteSetting ********** */
?>