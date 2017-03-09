<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $users = User::orderBy('name','asc')->get();
    return response()->json($users);
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
  public function store(UserRequest $request) {

    $user = new User($request->all());
    //bcrypt($data['password'])
    $user->password = Hash::make($user->password);
    $user->save();
    return response()->json($user);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {

    $user = User::find($id);

    if(is_null($user))
      return response()->json("Registro no encontrado", 404);
    else
      return response()->json($user);
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
  public function update(UserRequest $request, $id) {

    $user = User::find($id);

    if(is_null($user))
      return response()->json('Registro no encontrado', 404);
    else {

      $user->update($request->all());
      return response()->json($user);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $user = User::find($id);

    if(is_null($user)){
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $user->delete();
      return response()->json("Registro eliminado satisfactoriamente");
    }
  }
  
  /**
   * Authentication
   */
  public function authenticate(Request $request) {
    
    // Se almacenan las credenciales del usuario
    $credentials = $request->only('email', 'password');

    try {
      
      // se intenta verifica las credenciales y crear asi el token para el usuario
      if(!$token = JWTAuth::attempt($credentials)) {

        return response()->json(['error' => 'invalid credentials'], 401);
      }
    } 
    catch (JWTException $e) {
        
      // something went wrong whilst attempting to encode the token
      return response()->json(['error' => 'could not create token'], 500);
    }

    // all good so return the token
    return response()->json(compact('token'));
  }

  /**
   * Invalidate the token
   */
  public function logout() {

    $token = JWTAuth::getToken();

    try {

      JWTAuth::invalidate($token);      
    }
    catch(JWTException $e){

      return response()->json(['error' => 'could not invalidate the token'], 500);
    }
    return response()->json("Logout successfully");
  }
}
