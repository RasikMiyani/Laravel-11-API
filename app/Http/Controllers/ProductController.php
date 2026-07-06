<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        // return view('products.index', compact('products'));
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $product = new Product();
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image');
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();// 12224.jpeg
            // $imagePath->move(public_path('uploads/products'), $imageName);
            $imagePath->storeAs('uploads/products', $imageName, 'public');
            $product->image = $imageName;
        }
        $product->save();   
        // session()->flash('success', 'Product created successfully.');
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $oldImage = $product->image;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withErrors($validator)->withInput();
        } 
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        if ($request->hasFile('image')) {
            if ($oldImage != null && File::exists(public_path('storage/uploads/products/' . $oldImage))) {
                File::delete('storage/uploads/products/' . $oldImage);
            }
            $imagePath = $request->file('image');
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();// 12224.jpeg
            // $imagePath->move(public_path('uploads/products'), $imageName);
            $imagePath->storeAs('uploads/products', $imageName, 'public');
            $product->image = $imageName;
        }
        $product->save();   
        // session()->flash('success', 'Product created successfully.');
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete product image if exists
        if ($product->image && \Illuminate\Support\Facades\File::exists(public_path('storage/uploads/products/' . $product->image))) {
            \Illuminate\Support\Facades\File::delete(public_path('storage/uploads/products/' . $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
