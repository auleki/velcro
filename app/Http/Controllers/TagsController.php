<?php
namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller 
{
  public function store(Request $request, $id)
  {
    // dd($request);
    $tag = Tag::find($id);
    if($request->name) $tag->name = $request->name;
    if($request->value) $tag->value = $request->value;
    $tag->user_id = auth()->user()->id;

    $tag->save();
    return back();
  }
}