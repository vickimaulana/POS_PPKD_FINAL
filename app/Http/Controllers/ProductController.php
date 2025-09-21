<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $datas = Product::notDelete()->get();
        // return $datas;
        return view('admin.products.index', compact('datas'));
    }

    public function create()
    {
        $categories = Category::notDelete()->orderBy('category_name', 'asc')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|numeric|min:0',
            'product_qty' => 'required|numeric|min:0',
            'product_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('product_photo')) {
            $photoPath = $request->file('product_photo')->store('product_photos', 'public');
            $validatedData['product_photo'] = $photoPath;
        }

        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;

        Product::create($validatedData);
        Alert::success('Success', 'Product has been successfully created!');
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product || $product->is_deleted) {
            Alert::error('Error', 'Product not found');
            return redirect()->route('product.index');
        }
        $categories = Category::notDelete()->orderBy('category_name', 'asc')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product || $product->is_deleted) {
            Alert::error('Error', 'Product not found');
            return redirect()->route('product.index');
        }

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|numeric|min:0',
            'product_qty' => 'required|numeric|min:0',
            'product_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('product_photo')) {
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }
            $photoPath = $request->file('product_photo')->store('product_photos', 'public');
            $validatedData['product_photo'] = $photoPath;
        }

        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;

        $product->update($validatedData);
        Alert::success('Success', 'Product has been successfully updated!');
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product || $product->is_deleted) {
            Alert::error('Error', 'Product not found');
            return redirect()->route('product.index');
        }

        // if ($product->product_photo) {
        //     File::delete(public_path('storage/' . $product->product_photo));
        // }

        $product->update(['is_deleted' => 1]);
        Alert::success('Success', 'Product has been successfully deleted!');
        return redirect()->route('product.index');
    }

    public function stock()
    {
        $products = Product::active()->notDelete()->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->formatted_price,
                'image' => $product->product_photo,
                'qty' => (int)$product->product_qty,
            ];
        });
        // return $products;
        return view('admin.products.stock', compact('products'));
    }
}
