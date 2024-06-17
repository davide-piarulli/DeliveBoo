<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Requests\TypeRestaurantRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $types= Type::all();
        // return response()->json($types);

        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.type.create', compact ('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRestaurantRequest $request)
    {
        $form_data= $request->all();
        $exist = Type::where('name', $form_data['name'])->first();
        if ($exist) {
        return redirect()->route('admin.types.index')->with('error', 'Nome del tipo già esiste');
        } else {
        $new_type_restaurant = new Type();
        $new_type_restaurant->fill($form_data);
        $new_type_restaurant->save();
        return redirect()->route('admin.types.index')->with('success', 'Tipo aggiunto correttamente!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRestaurantRequest $request, Type $type)
    {
        $form_data = $request->all();
        $type->update($form_data);
        return redirect()->route('admin.types.index', $type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('deleted', 'Il tipo è stato cancellato');
    }
}
