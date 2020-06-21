<?php

namespace App\Http\Controllers;

use \App\Product;

use \App\Category;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

use \App\Http\Requests\Products\CreateProductRequest;

use \App\Http\Requests\Products\UpdateProductRequest;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        foreach($products as $product){
            $product->product_id += $product->id+10000;
        }

        return view('staff.product.product')->with('products', $products);
    }

    public function customerIndex()
    {
        $categories = Category::all();
        $products = Product::where('status', '=', 'Active')->get();

        return view('customer.product.product')->with('products', $products)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('staff.product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $price = NULL;
        if($request->price) $price = $request->price; 

        $image = $request->image->store('product');

        $product = Product::create([
          'title' => $request->title,
          'description' => $request->description,
          'price' => $price,
          'image' => $image,
          'tenure' => $request->tenure,
          'category_id' => $request->category,
        ]);

        // flash message
        session()->flash('success', 'Product created successfully.');
        // redirect user

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('customer.product.detail')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories=Category::all();

        return view('staff.product.create')->with('product', $product)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //dd($request);
        $data = $request->only(['title', 'description', 'price', 'tenure']);
        // check if new image
        $image = "storage/".$product->image;

        $data['category_id'] = $request->category;

        if (File::exists($image) && $request->image) {
            // delete old one
            File::delete($image);
            // upload it
            $image = $request->image->store('product');
            $data['image'] = $image;
        }
        else if($request->image){
            $image = $request->image->store('product');
            $data['image'] = $image;
        }

        // update attributes
        $product->update($data);

        // flash message
        session()->flash('success', 'Product updated successfully.');

        // redirect user
        return redirect(route('products.index'));
    }

    public function updateStatus(Product $product)
    {
        $status = $product->status;

        if($status == "Active"){
            $product->update([
                'status' => 'Inactive'
            ]);

            session()->flash('success', 'Product updated successfully.');

            return redirect(route('products.index'));
        }

        $product->update([
            'status' => 'Active'
        ]);

        session()->flash('success', 'Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
