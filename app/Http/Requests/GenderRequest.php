<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class GenderRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(){

    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {

    // Validation rule for field name by default (Http POST method, action store)
    $name_validation = 'required|unique:genders|min: 3|max:80';

    // Validation rule for field name on action update
    if($this->method() == "PUT" || $this->method() == "PATCH") {

      $name_validation = 'required|min: 4|max:80|unique:genders,name,'.$this->id.'';
    }

    return [
      'name' => $name_validation
    ];
  }

  /**
   * Configure the validator instance.
   *
   * @param  \Illuminate\Validation\Validator  $validator
   * @return void
   */
  // public function withValidator($validator) {
  //
  //   $validator->after(function ($validator) {
  //     if ($this->somethingElseIsInvalid()) {
  //       $validator->errors()->add('field', 'Something is wrong with this field!');
  //     }
  //   });
  // }

  /**
   * [messages description]
   * @return [type] [description]
   */
  public function messages(){
    return [
      'name.required' => 'The :attribute field is required',
      'name.unique' => 'The :attribute has already been taken',
      'name.min' => 'The :attribute must be at least 3 characters',
      'name.max' => 'The :attribute not be greater than 120 characters'
    ];
  }
}
