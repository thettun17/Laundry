<?php
Route::post('orders/store',"OrderController@store");
Route::get('order',"OrderController@point");
Route::get('point/{id}',"BasketController@point");
Route::get('pointshow',"BasketController@pointshow");
Route::get('/', function () {
    return redirect('items');
});

Auth::routes();
Route::get('items/create','ItemController@create');
Route::post('items/store','ItemController@store');
Route::get('itemshow',"ItemController@show");
Route::get('item/edit/{id}',"ItemController@edit");
Route::post('item/update/{id}',"ItemController@update");
Route::get('item/delete/{id}',"ItemController@destroy");
Route::post('changename',"UserController@changename");

//-----------------User---------------------------
Route::get('users','UserController@index');
Route::get('user/show{id}',"UserController@show");
Route::post('changepassword','UserController@changepassword');
Route::get('adduser' , 'UserController@create');
Route::post('storeuser' , 'UserController@store');
//--------------------------------------------------

Route::get('/home', 'HomeController@index')->name('home');
Route::get('namechange','UserController@namechange');
Route::get('passwordchange','UserController@passwordchange');

//-------------- Points ----------------------------------
Route::resource('points','PointController');
//---------------------------------------------------------

//------------------Orderuser--------------
Route::get('orderlist','UserController@orderuser');
Route::get('orderdetail/{id}','UserController@orderdetail');
Route::get('washlist','UserController@washlist');
Route::get('washfinish/{id}','UserController@washfinish');
Route::get('deliverlist','UserController@deliverlist');
Route::get('deliverfinish/{id}','UserController@deliverfinish');
Route::get('adminorderdetails','OrderController@orderdetails');
//-----------------------Route Group-----------------------------
Route::middleware('notadmin')->group(function () {
Route::get('buypoint/{id}','PointController@buypoint');
Route::get('additem/{id}','BasketListController@store');
Route::get('orders/create' , 'OrderController@create');
Route::get('orderhistory',"UserController@orderhistory");
Route::get('userorderdetail/{id}',"UserController@userorderdetail");
Route::post('personorderhistory' , 'UserController@personorderhistory');
Route::get('recieved' , 'UserController@recieved');
Route::get('notrecieved' , 'UserController@notrecieved');
});
//---------------------BasketListcontroller-------------------------
Route::post('itemsearch','ItemController@itemssearch');
Route::get('items','ItemController@index');
Route::get('basketLists','BasketListController@index');
Route::get('updatesession/{id}','BasketListController@update');
Route::get('deletesession/{id}','BasketListController@destroy');
Route::post('filterorder','OrderController@filterorder');
Route::get('wash' , 'OrderController@washing');
Route::get('delivered' , 'OrderController@delivered');
Route::get('notdelivered' , 'OrderController@notdelivered');

//----------------------About Us & Contact Us------------------------------
Route::get('aboutus' , 'HomeController@aboutus');