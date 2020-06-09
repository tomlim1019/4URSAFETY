<?php

namespace App\Http\Controllers;

use App\Product;

use App\User;

use App\Quotation;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::all();

        return view('staff.request.request')->with('quotations', $quotations);
    }

    public function customerIndex()
    {
        $quotations = Quotation::where('user_id', Auth::user()->id)->get();

        return view('customer.request.request')->with('quotations', $quotations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Quotation::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id
          ]);
  
        session()->flash('success', 'Purchase requested successfully.');

        return redirect(route('customer.product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        return view('customer.request.detail')->with('request', $quotation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $user = User::find($quotation->user_id);
        $product = Product::find($quotation->product_id);

        return view('staff.request.view')->with('quotation', $quotation)->with('user', $user)->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $data = $request->only(['status']);

        $quotation->update($data);

        $output = 'Request '.$data['status'].' successfully.';

        session()->flash('success', $output);

        return redirect(route('quotations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        session()->flash('success', 'Request Deleted Successfully.');

        return redirect(route('customer.request'));
    }
}
