<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Restaurant $restaurant)
    {
      $restaurant = Restaurant::where('id', Auth::user()->id)->first();

      return view('admin.restaurant.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {

      $form_data = $request->all();

      if (array_key_exists('logo', $form_data) && $form_data['isUploaded'] == 'true') {
          $file = Storage::disk('public')->put('uploads', $form_data['logo']);
          $original_name = $request->file('logo')->getClientOriginalName();

          $form_data['logo'] = $file;
          $form_data['image_original_name'] = $original_name;
      } elseif (!array_key_exists('image', $form_data) && $form_data['isUploaded'] == 'true') {
          $form_data['logo'] = $restaurant->image;
          $form_data['image_original_name'] = $restaurant->image_original_name;
      } else {
          $form_data['logo'] = null;
          $form_data['image_original_name'] = null;
      }

      $restaurant->update($form_data);

      return redirect()->route('admin.products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
