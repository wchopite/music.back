<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {

    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {

    // Validation rule for field name by default (Http POST method, action store)
    $name_validation = 'required|unique:users|min: 4|max:60';
    $email_validation = 'required|unique:users|email';
    $password_validation = 'required';

    // Validation rule for field name on action update
    if($this->method() == "PUT" || $this->method() == "PATCH") {

      $name_validation = 'required|min: 4|max:60|unique:users,name,'.$this->user;
      $email_validation = 'required|email|unique:users,email,'.$this->user;
      $password_validation = '';
    }

    return [
      'name' => $name_validation,
      'email' => $email_validation,
      'password' => $password_validation
    ];
  }

  /**
   * [messages description]
   * @return [type] [description]
   */
  public function messages() {

    return [
      'name.required' => 'El campo nombre es requerido',
      'name.unique' => 'El nombre indicado ya ha sido registrado',
      'name.min' => 'El campo nombre debe tener al menos 4 caracteres',
      'name.max' => 'El campo nombre no puede contener mas de 60 caracteres',
      'email.required' => 'El campo email es requerido',
      'email.unique' => 'El email indicado ya ha sido registrado'
    ];
  }
}
