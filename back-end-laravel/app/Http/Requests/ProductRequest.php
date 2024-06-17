<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
      "name" => "required|min:3|max:50",
      "description" => "max:1000",
      "price" => "required|max:999",
      "image" => "image|mimes:png,jpg|max:20480",
      "product_type_id" => "required",
    ];
  }

  public function messages(): array
    {

      return [

        'name.required' => 'Il campo nome è obbligatorio.',
        'name.min' => 'Il nome deve avere almeno :min caratteri.',
        'name.max' => 'Il nome non può superare :max caratteri.',
        'description.max' => 'La descrizione non può superare :max caratteri.',
        'price.required' => 'Il campo prezzo è obbligatorio.',
        'price.max' => 'Il prezzo non può essere superiore a :max.',
        'image.image' => "Il file caricato deve essere un'immagine.",
        'image.mimes' => "L'immagine deve essere un file di tipo: png, jpg.",
        'image.max' => "L'immagine non può superare i :max kilobytes.",
        'product_type_id.required' => "Seleziona un tipo di prodotto",

      ];

    }
}
