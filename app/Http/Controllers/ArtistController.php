<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist;
use App\Http\Requests\ArtistRequest;

class ArtistController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $artists = Artist::orderBy('name','asc')->get();
    return response()->json($artists);
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
  public function store(ArtistRequest $request) {

    $artist = new Artist($request->all());
    $artist->save();
    return response()->json($artist);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {

    $artist = Artist::find($id);

    if(is_null($artist))
      return response()->json("Registro no encontrado", 404);
    else
      return response()->json($artist);
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
  public function update(ArtistRequest $request, $id) {

    $artist = Artist::find($id);

    if(is_null($artist)) {
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $artist->update($request->all());
      return response()->json($artist);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $artist = Artist::find($id);

    if(is_null($artist)) {
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $artist->delete();
      return response()->json("Registro eliminado satisfactoriamente");
    }
  }
}
