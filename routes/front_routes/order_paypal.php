<?php

/* * ******** OrderController ************ */

Route::get('ajax/employer-package/noOfUser/freeForMonth', 'PaypalOrderController@employeePackagesByNoOfUserAndFreeForMonth')->name('ajax.employee.packages.user.month');
Route::get('employer-package/list', 'PaypalOrderController@employeePackages')->name('employee.packages.list');
Route::post('paypal/order-package/{id}', 'PaypalOrderController@orderPackage')->name('paypal.order.package');

Route::post('paypal/order-renew-package', 'PaypalOrderController@orderRenewPackage')->name('paypal.order.renew.package');
Route::get('paypal/order-renew-payment-status/{id}', 'PaypalOrderController@getRenewPaymentStatus')->name('paypal.renew.payment.status');

Route::post('paypal/order-upgrade-package', 'PaypalOrderController@orderUpgradePackage')->name('paypal.order.upgrade.package');
Route::get('paypal/order-upgrade-payment-status/{id}', 'PaypalOrderController@getUpgradePaymentStatus')->name('paypal.upgrade.payment.status');

Route::get('paypal/payment-status/{id}/{userId}', 'PaypalOrderController@getPaymentStatus')->name('paypal.payment.status');

Route::post('/paypal/order/save', 'PaypalOrderController@apiPaypalSave')->name('api.paypal.order.save');

Route::get('paypal/order/package', array('as' => 'paypal.order.package','uses' => 'PaypalController@payWithPaypal'));

Route::post('createorder/{userId}/{packageId}/{paymentFor}', array('as' => 'paypal.createorder','uses' => 'PaypalController@postPaymentWithpaypal'));
;
Route::post('capture/order/{orderID}/capture', array('as' => 'paypal.captureorder','uses' => 'PaypalController@capturePaymentWithpaypal'));
Route::get('paypalreturn', array('as' => 'paypal.paypalreturn','uses' => 'PaypalController@returnpPaypal'));
Route::get('paypalcancel', array('as' => 'paypal.paypalcancel','uses' => 'PaypalController@cancelPaypal'));