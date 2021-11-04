<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CrudController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    $students = app('firebase.firestore')->database()->collection('User')->documents();
    return view('Crud/index',compact('students'));
    // return dd($students);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    if ($request->doc_id == null) {
      // Uplode Data
      $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'age' => 'required',
       ]);
      $stuRef = app('firebase.firestore')->database()->collection('User')->newDocument();
      $stuRef->set([
        'firstname' => $request->first_name,
        'lastname' => $request->last_name,
        'age'    => $request->age,
      ]);
      Session::flash('message', 'Information Uploaded');
      return back()->withInput();
    }
    else {

      $student = app('firebase.firestore')->database()->collection('User')->document($request->doc_id)->snapshot();

      $name = $student->data()['firstname'];
      $lname = $student->data()['lastname'];
      $age = $student->data()['age'];

      $data = sprintf("Name : %s %s \n and Age : %s", $name, $lname, $age);

      Session::flash('message',  $data);
      return back()->withInput();

    }


  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    echo $id;
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
    $student = app('firebase.firestore')->database()->collection('User')->document($id)
   ->update([
    ['path' => 'firstname', 'value' => $request->firstname],
    ['path' => 'lastname', 'value' => $request->lastname],
    ['path' => 'age', 'value' => $request->age],
   ]);
   return back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
    app('firebase.firestore')->database()->collection('User')->document($id)->delete();
    return back();
  }
}
