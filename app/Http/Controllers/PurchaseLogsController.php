<?php

namespace App\Http\Controllers;

use App\PurchaseLog;

use App\Quotation;

use App\User;

use App\Product;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PurchaseLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = PurchaseLog::all();

        return view('staff.purchaselog.logs')->with('logs', $logs);
    }

    public function customerIndex()
    {
        $logs = PurchaseLog::where('user_id', Auth::user()->id)->get();

        return view('customer.product.myProduct')->with('logs', $logs);
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
        Quotation::where('id', $request->request_id)->delete();

        PurchaseLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id
          ]);
  
        session()->flash('success', 'Product Purchase successfully.');

        return redirect(route('customer.request'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseLog $log)
    {
        return view('customer.product.myProductDetail')->with('log', $log);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseLog $log)
    {
        $user = User::find($log->user_id);
        $product = Product::find($log->product_id);

        return view('staff.purchaselog.view')->with('log', $log)->with('user', $user)->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
