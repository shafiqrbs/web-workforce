<?php
Route::get('financial/partner', 'FinancialPartnerController@index')->name('financial_partner');
Route::get('financial/partner/details/{slug}', 'FinancialPartnerController@details')->name('financial_partner_details');
