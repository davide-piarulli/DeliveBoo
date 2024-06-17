<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  public function index()
  {
    $products = Product::paginate(8);
    return view('admin.products.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      return view('admin.products.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
      $form_data = $request->all();

      if ($request->hasFile('image')) {
          $image_path = Storage::put('uploads', $form_data['image']);
          $form_data['image'] = $image_path;
      }

      $new_product = Product::create($form_data);

      return redirect()->route('admin.products.show', $new_product);
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
      return view('admin.products.show', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product)
  {
      return view('admin.products.edit', compact('product'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
      $form_data = $request->all();

      if ($request->hasFile('image')) {
          if ($product->image) {
              Storage::delete($product->image);
          }
          $image_path = Storage::put('uploads', $form_data['image']);
          $form_data['image'] = $image_path;
      }

      $product->update($form_data);

      return redirect()->route('admin.products.show', $product);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
      if ($product->image) {
          Storage::delete($product->image);
      }

      $product->delete();

      return redirect()->route('admin.products.index');
  }

}
