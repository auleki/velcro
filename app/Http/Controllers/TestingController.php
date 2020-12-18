<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Met;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.testing');
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
      $this->validate($request, [
        'name' => 'required',

      ]);

      //Create Report
      $met = new Met;
      $met->name =$request->input('name');

      $met->save();//Reports are saved in the DB here

      return redirect('/test')->with('success', 'Met Successful added');
    }


    public function upload(Request $request)
    {
      $met = new Met;
      $CKEditor = Input::get('CKEditor');
      $funcNum = Input::get('CKEditorFuncNum');
      $message = $url = '';
      if (Input::hasFile('upload')) {
          $file = Input::file('upload');
          if ($file->isValid()) {
              $filename = $file->getClientOriginalName();
              $file->move(storage_path().'/images/', $filename);
              $url = public_path() .'/images/' . $filename;
              $met->name = $fileName;
              $met->save();
          } else {
              $message = 'An error occured while uploading the file.';
          }
      } else {
          $message = 'No file uploaded.';
      }
      return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $met = Met::all();
        return view('reports/testing11')->with(compact('met'));
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
    }
}
