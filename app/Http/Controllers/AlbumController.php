<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Http\Requests\AlbumRequest;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $albums = Album::orderBy('name','asc')
      ->with('gender','artist','user')
      //->select('id','name','gender_id','artist_id')
      ->get();

    return response()->json($albums);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() { }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AlbumRequest $request) {

    if($request->hasFile('image')) {
      
      //$ext = $request->image->getClientOriginalName();
      $ext = $request->image->extension();
      $fileName = time().".".$ext;

      $path = $request->image->storeAs('public',$fileName);

      $album = new Album($request->all());
      $album->path = Storage::url($path);
      $album->save();
      return response()->json($album);
    }
    else {

      return response()->json("Debe indicar la imagen del album",400);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {

    $album = Album::where('id',$id)->with('gender','artist','user')->first();

    if(is_null($album))
      return response()->json("Registro no encontrado", 404);
    else
      return response()->json($album);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) { }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(AlbumRequest $request, $id) {

    $album = Album::find($id);

    if(is_null($album))
      return response()->json('Registro no encontrado', 404);
    else {

      if($request->hasFile('image')) {

        $dirs = explode("/", $album->path);
        //$dirs[0] = 'storage';
        //$dirs[1] = '12132323.jpg';
        Storage::delete('public/'.$dirs[count($dirs)-1]);
        $path = $request->image->storeAs('public',$dirs[count($dirs)-1]);
      }

      $album->update($request->all());
      return response()->json($album);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $album = Album::find($id);

    if(is_null($album)){
      return response()->json('Registro no encontrado', 404);
    }
    else {
      
      $dirs = explode("/", $album->path);
      Storage::delete('public/'.$dirs[count($dirs)-1]);
      $album->delete();      
      return response()->json("Registro eliminado satisfactoriamente");
    }
  }
}
