<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Functions\Helper;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.product.owner')->except(['index', 'orderBy', 'create', 'store']);
    }

    public function index()
    {
        $products = Product::where('restaurant_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        $dir = 'desc';
        $col = null;

        return view('admin.products.index', compact('products', 'dir', 'col'));
    }

    public function orderBy($col, $dir)
    {
        $dir = $dir === 'desc' ? 'asc' : 'desc';

        $products = Product::where('restaurant_id', Auth::user()->id)->orderBy($col, $dir)->paginate(10);
        $productTypes = ProductType::all();

        return view('admin.products.index', compact('productTypes', 'products', 'dir', 'col'));
    }

    public function create()
    {
        $productTypes = ProductType::all();
        return view('admin.products.create', compact('productTypes'));
    }

    public function store(ProductRequest $request)
    {
        $form_data = $request->all();

        if (array_key_exists('image', $form_data)) {
            $file = Storage::disk('public')->put('uploads', $form_data['image']);
            $original_name = $request->file('image')->getClientOriginalName();

            $form_data['image'] = $file;
            $form_data['image_original_name'] = $original_name;
        } else {
            $form_data['image'] = null;
            $form_data['image_original_name'] = null;
        }

        if (empty($form_data['slug'])) {
            $form_data['slug'] = Helper::generateSlug($form_data['name'], Product::class);
        }

        $form_data['restaurant_id'] = Auth::user()->id;

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

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $form_data = $request->all();

        if (array_key_exists('image', $form_data) && $form_data['isUploaded'] == 'true') {
            $file = Storage::disk('public')->put('uploads', $form_data['image']);
            $original_name = $request->file('image')->getClientOriginalName();

            $form_data['image'] = $file;
            $form_data['image_original_name'] = $original_name;
        } elseif (!array_key_exists('image', $form_data) && $form_data['isUploaded'] == 'true') {
            $form_data['image'] = $product->image;
            $form_data['image_original_name'] = $product->image_original_name;
        } else {
            $form_data['image'] = null;
            $form_data['image_original_name'] = null;
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
