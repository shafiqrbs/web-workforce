<?php
//Route::prefix('{locale/}')->group(function() {
    /* * ******  FAQ Field Start ********** */
//    $sup_only = ['allowed_roles' => 'SUP_ADM'];

    Route::get('list-faqs', array_merge(['uses' => 'Admin\FaqController@indexFaqs'], $sup_only))->name('list.faqs');
    Route::get('create-faq', array_merge(['uses' => 'Admin\FaqController@createFaq'], $sup_only))->name('create.faq');
    Route::post('store-faq', array_merge(['uses' => 'Admin\FaqController@storeFaq'], $sup_only))->name('store.faq');
    Route::get('edit-faq/{id}/{industry_id?}', array_merge(['uses' => 'Admin\FaqController@editFaq'], $sup_only))->name('edit.faq');
    Route::put('update-faq/{id}', array_merge(['uses' => 'Admin\FaqController@updateFaq'], $sup_only))->name('update.faq');
    Route::delete('delete-faq', array_merge(['uses' => 'Admin\FaqController@deleteFaq'], $sup_only))->name('delete.faq');
    Route::get('fetch-faqs', array_merge(['uses' => 'Admin\FaqController@fetchFaqsData'], $sup_only))->name('fetch.data.faqs');
    Route::get('sort-faq', array_merge(['uses' => 'Admin\FaqController@sortFaqs'], $sup_only))->name('sort.faqs');
    Route::get('faq-sort-data', array_merge(['uses' => 'Admin\FaqController@faqSortData'], $sup_only))->name('faq.sort.data');
    Route::put('faq-sort-update', array_merge(['uses' => 'Admin\FaqController@faqSortUpdate'], $sup_only))->name('faq.sort.update');
    /* * ****** End FAQ Field ********** */
//});
?>