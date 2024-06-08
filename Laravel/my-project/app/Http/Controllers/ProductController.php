<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = array();
        foreach (Category::all() as $category){
            $categories[$category->id] = $category->name;
        }
        return view('product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'=> 'required|max:255',
    //         'category_id' => 'required|integer',
    //         'description' => 'required|max:255',
    //         'price' => 'required|numeric|min:0', // Corrected validation for price
    //         'image' => 'required|image|mimes:jpg,jpeg,png,gif', // Corrected validation for image
            
    //     ]);

    //     // Create The Category
    //     $image = $request->file('image');
    //     $upload = 'img/';
    //     $filename = time().$image->getClientOriginalName();
    //     move_uploaded_file($image->getPathName(),$upload. $filename);

    //     $product = new Product;
    //     $product->name = $request->name;
    //     $product->category_id = $request->category_id;
    //     $product->description = $request->description;
    //     $product->price = $request->price;
    //     $product->image = $request->$filename;
    //     $product->save();
    //     Session::flash('product_create','Product is created.');
    //     return redirect('/product/create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|integer',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $imageName = $request->file('image')->getClientOriginalName(); // Get the original image name

        // Store the image in the public/img directory
        $request->file('image')->move(public_path('img'), $imageName);

        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $imageName; // Save the image path
        $product->save();

        // Flash message
        Session::flash('product_create', 'Product is created.');

        return redirect('/product/create');
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
        $product = Product::find($id);
        if (!$product) {
            return redirect('/product')->with('error', 'Product not found.');
        }

        $categories = Category::pluck('name', 'id');
        return view('product.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect('/product')->with('error', 'Product not found.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|integer',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);

        // Update the product attributes
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imageName);
            $product->image = $imageName;
        }
        $product->save();

        // Flash message
        Session::flash('product_update', 'Product is updated.');

        return redirect('/product')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Check if the product has an image
        if ($product->image) {
            // Get the image path
            $imagePath = public_path('img') . '/' . $product->image;

            // Check if the file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the product
        $product->delete();

        // Redirect back or wherever appropriate
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


}
