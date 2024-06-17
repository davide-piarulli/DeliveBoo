<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'required|min:3|max:50'
    ];
  }

  public function message(): array
  {
    return [
      'name.required' => 'Il nome è obbligatorio',
      'name.min' => 'Il nome deve avere almeno :min caratteri',
      'name.max' => 'Il nome può avere massimo :max caratteri'
    ];
  }
}
