<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Functions\Helper;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $productTypes = ProductType::all();
        return view('admin.products.create', compact('productTypes'));
    }

    public function store(Request $request)
    {
        $form_data = $request->except('_token');

        if ($request->hasFile('image')) {
            $image_path = Storage::put('uploads', $request->file('image'));
            $form_data['image'] = $image_path;
        }

        if (empty($form_data['slug'])) {
            $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
        }

        $new_product = Product::create($form_data);

        return redirect()->route('admin.products.show', $new_product);
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $productTypes = ProductType::all();
        return view('admin.products.edit', compact('product', 'productTypes'));
    }

    public function update(Request $request, Product $product)
    {
        $form_data = $request->except('_token');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $image_path = Storage::put('uploads', $request->file('image'));
            $form_data['image'] = $image_path;
        }

        if (empty($form_data['slug'])) {
            $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
        }

        $product->update($form_data);

        return redirect()->route('admin.products.show', $product);
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
