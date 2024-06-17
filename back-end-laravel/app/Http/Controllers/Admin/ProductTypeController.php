<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Functions\Helper as Help;
use App\Http\Requests\ProductTypeRequest;

class ProductTypeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $productsType = ProductType::all();
    return view('admin.productsType.index', compact('productsType'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.productsType.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductTypeRequest $request)
  {
    $form_data = $request->all();
    // dd($form_data);
    $exist = ProductType::where('name', $form_data['name'])->first();
    if ($exist) {
      return redirect()->route('admin.productsType.index')->with('error', 'Nome del tipo già esiste');
    } else {
      $new_type = new ProductType();
      // slug commentato, valutare se aggiungerlo nella migration
      // $form_data['slug'] = Help::generateSlug($form_data['name'], ProductType::class);
      //? Riempio e salvo
      $new_type->fill($form_data);
      $new_type->save();
      //? Ridireziono
      return redirect()->route('admin.productsType.index')->with('success', 'Tipo aggiunto correttamente!');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ProductType $productsType)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ProductTypeRequest $request, ProductType $productsType)
  {
    $form_data = $request->all();
    $productsType->update($form_data);
    return redirect()->route('admin.productsType.index', $productsType);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ProductType $productsType)
  {
    $productsType->delete();
    return redirect()->route('admin.productsType.index')->with('deleted', 'Il tipo è stato cancellato');
  }
}
