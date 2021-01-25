<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('/firestore', App\Http\Controllers\FirebaseController::class);

Route::get('/insert', function() {
	 $stuRef = app('firebase.firestore')->database()->collection('User')->newDocument();
	 $stuRef->set([
		'firstname' => 'John',
		'lastname' => 'Doe',
		'age'    => 30
 ]);
 echo "<h1>".'inserted'."</h1>";
});

Route::get('/display', function(){
  $student = app('firebase.firestore')->database()->collection('User')->document('7cdf5e1a544d4c2995eb')->snapshot();
  print_r('Student ID ='.$student->id());
  print_r("<br>". 'Student Name = '.$student->data()['firstname']);
  print_r("<br>".'Student Age = '.$student->data()['age']);
});

Route::get('/update', function(){
  $student = app('firebase.firestore')->database()->collection('User')->document('7cdf5e1a544d4c2995eb')
 ->update([
  ['path' => 'age', 'value' => '50']
 ]);
 echo "<h1>".'updated'."</h1>";
});

Route::get('/delete', function(){
 app('firebase.firestore')->database()->collection('User')->document('7cdf5e1a544d4c2995eb')->delete();
 echo "<h1>".'deleted'."</h1>";
});
