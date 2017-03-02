<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest {

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
    $name_validation = 'required|unique:artists|min: 3|max:80';

    // Validation rule for field name on action update
    if($this->method() == "PUT" || $this->method() == "PATCH") {

      $name_validation = 'required|min: 4|max:80|unique:artists,name,'.$this->artist.'';
    }

    return [
      'name' => $name_validation
    ];
  }

  /**
   * [messages description]
   * @return [type] [description]
   */
  public function messages() {

    return [
      'name.required' => 'The :attribute field is required',
      'name.unique' => 'The :attribute has already been taken',
      'name.min' => 'The :attribute must be at least 3 characters',
      'name.max' => 'The :attribute not be greater than 120 characters'
    ];
  }
}
