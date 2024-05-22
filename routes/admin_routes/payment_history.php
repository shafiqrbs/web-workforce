<?php

/* * ******  PaymentHistory Start ********** */
Route::get('payment-history', array_merge(['uses' => 'Admin\PaymentHistoryController@indexPaymentHistory'], $all_users))->name('payment.history');

/* * ****** End PaymentHistory ********** */