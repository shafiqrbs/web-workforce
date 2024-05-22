<?php


Route::get('judges-jury','JudgesJuryController@index')->name('judges_jury');
Route::get('judges-jury/details/{id}', 'JudgesJuryController@juryDetails')->name('jury_details');
//Route::get('committee/details/office/{id}', 'CommitteeMemberController@memberDetailsOffice')->name('committee_members_detais_office');
