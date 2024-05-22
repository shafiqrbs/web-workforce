<?php

/* * ******  Financial partner route Start ********** */
Route::get('financial-partner/list', array_merge(['uses' => 'Admin\FinancalPartnerController@index'], $sup_only))->name('financial_partner_list');
Route::get('financial-partner/create', array_merge(['uses' => 'Admin\FinancalPartnerController@create'], $sup_only))->name('financial_partner_add');
Route::post('financial-partner/store', array_merge(['uses' => 'Admin\FinancalPartnerController@store'], $sup_only))->name('financial_partner_store');
Route::get('financial-partner/edit/{id}', array_merge(['uses' => 'Admin\FinancalPartnerController@edit'], $sup_only))->name('financial_partner_edit');
Route::post('financial-partner/update/{id}', array_merge(['uses' => 'Admin\FinancalPartnerController@update'], $sup_only))->name('financial_partner_update');
Route::delete('financial-partner/delete', array_merge(['uses' => 'Admin\FinancalPartnerController@destroy'], $sup_only))->name('financial_partner_delete');
Route::get('financial-partner/sort', array_merge(['uses' => 'Admin\FinancalPartnerController@sortFinancialPartner'], $sup_only))->name('financial_partner_sort');
Route::get('financial-partner/sort/data', array_merge(['uses' => 'Admin\FinancalPartnerController@financialPartnerSortData'], $sup_only))->name('financial_partner_sort_data');
Route::put('financial-partner/sort/data/update', array_merge(['uses' => 'Admin\FinancalPartnerController@financialPartnerSortDataUpdate'], $sup_only))->name('financial_partner_sort_data_update');

Route::put('make-not-active-partner', array_merge(['uses' => 'Admin\FinancalPartnerController@makeNotActivePartner'], $sup_only))->name('make.not.active.partner');
Route::put('make-active-partner', array_merge(['uses' => 'Admin\FinancalPartnerController@makeActivePartner'], $sup_only))->name('make.active.partner');

/* * ****** Financial partner route End ********** */
?>