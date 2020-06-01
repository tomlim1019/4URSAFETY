<?php

namespace App\Http\Controllers;

use \App\Product;

use \App\Category;

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

        return view('product.product')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('product.create')->with('categories', $categories);
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
        // upload the image to storage
        $image = $request->image->store('products');
        // create the post
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
    public function show($id)
    {
        //
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

        return view('product.create')->with('product', $product)->with('categories', $categories);
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
        $data = $request->only(['title', 'description', 'price', 'tenure']);
        // check if new image
        if ($request->hasFile('image')) {
          // uplload it
          $image = $request->image->store('products');
          // delete old one
          //$product->deleteImage();

          $data['image'] = $image;
        }

        // update attributes
        $products->update($data);

        // flash message
        session()->flash('success', 'Post updated successfully.');

        // redirect user
        return redirect(route('product.index'));
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
