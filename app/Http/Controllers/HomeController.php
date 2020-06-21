<?php

namespace App\Http\Controllers;

use App\User;

use App\PurchaseLog;

use App\Quotation;

use App\Product;

use App\Http\Requests\ImageRequest;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == "customer"){
            $products = Product::where('status', '=', 'Active')
                            ->orderBy('id', 'desc')
                            ->take(5)
                            ->get();

            $logs = PurchaseLog::where('user_id', Auth::user()->id)
                            ->orderBy('id', 'desc')
                            ->take(2)
                            ->get();

            $quotations = Quotation::where('user_id', Auth::user()->id)
                            ->orderBy('id', 'desc')
                            ->take(2)
                            ->get();

            return view('customer.home')->with('logs', $logs)->with('quotations', $quotations)->with('products', $products);
        }

        $logCounted = PurchaseLog::all()->count('id');
        
        $pRequestCounted = Quotation::where('status', '=', 'Pending')->count('id');

        $pCustomerCounted = User::where('status', '=', 'Pending')->count('id');

        $products = Product::where('status', '=', 'Active')->get();
        
        foreach($products as $product){
            $product->product_id += $product->id+10000;
        }

        return view('staff.home')->with('sales', $logCounted)
                ->with('pendingRequest', $pRequestCounted)
                ->with('pendingCustomer', $pCustomerCounted)
                ->with('products', $products);
    }

    public function profile()
    {
        return view('profile.profile')->with('profile', auth()->user());
    }

    public function submitApproval(User $user)
    {
        $user->update([
            'status' => 'Pending'
        ]);

        session()->flash('success', 'Request submitted successfully.');

        return redirect(route('profile'));
    }

    public function resetPassword(Request $request, User $user)
    {
        if (Hash::check($request->password, $user->password)) {
            if($request->newPassword == $request->confirmPassword){
                $user->update([
                    'password' => Hash::make($request->newPassword)
                ]);
                session()->flash('success', 'Password changed successfully.');
            }
            else session()->flash('danger', 'New password and Confirm password not match.');
        }
        else session()->flash('danger', 'Current Password not match.');

        return redirect(route('profile'));
    }

    public function uploadPicture(Request $request, User $user)
    {
        $image = "storage/".$user->image;

        if (File::exists($image) && $request->image) {
            // delete old one
            File::delete($image);
            // upload it
            $image = $request->image->store('profile');
        }
        else if($request->image) $image = $request->image->store('profile');

        // update attributes
        $user->update([
            'image' => $image,
        ]);

        // flash message
        session()->flash('success', 'Picture updated successfully.');

        // redirect user
        return redirect(route('profile'));
    }

    public function uploadDocument(Request $request, User $user)
    {
        $document = "storage/".$user->document;

        if (File::exists($document)) {
            // delete old one
            File::delete($document);
            // upload it
            $document = $request->document->store('idcard');
        }
        else $document = $request->document->store('idcard');

        // update attributes
        $user->update([
            'document' => $document,
        ]);

        // flash message
        session()->flash('success', 'Document updated successfully.');

        // redirect user
        return redirect(route('profile'));
    }
}
