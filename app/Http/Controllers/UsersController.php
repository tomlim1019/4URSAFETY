<?php

namespace App\Http\Controllers;

use App\User;

use App\Quotation;

use App\PurchaseLog;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function customerIndex()
    {
        $users = User::where('role', 'customer')->get();

        return view('staff.user.customer')->with('customers', $users);
    }

    public function staffIndex()
    {
        $users = User::whereIn('role', ['admin', 'staff'])->get();

        return view('staff.user.staff')->with('staffs', $users);
    }

    public function createStaff(Request $request)
    {
        $password = '4ursafety';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_no' => $request->id_no,
            'gender' => $request->gender,
            'role' => $request->role,
            'status' => $request->status,
            'password' => Hash::make($password),
            'birthdate' => $request->birthdate,
        ]);

        session()->flash('success', 'Staff created successfully, password is '.$password.'.');

        return redirect(route('staff'));
    }

    public function editCustomer(User $user)
    {
        return view('staff.user.detail')->with('customer', $user);
    }

    public function customerApproval(Request $request, User $user)
    {
        if($request->status == 'Rejected'){
            $count_1 = Quotation::where('user_id', '=', $user->id)->count();
            $count_2 = PurchaseLog::where('user_id', '=', $user->id)->count();
            if($count_1 > 0 || $count_2 >0){
                session()->flash('danger', 'Customer cannot be rejected! There are products/requests under this customer!');

                return redirect(route('customer'));
            }
        }

        $user->update([
            'status' => $request->status
          ]);
  
          session()->flash('success', 'Customer '.$user->status.' successfully.');
  
          return redirect(route('customer'));
    }

    public function editStaffRole(Request $request, User $user)
    {
        $user->update([
            'role' => $request->role
          ]);
  
          session()->flash('success', 'Staff updated successfully.');
  
          return redirect(route('staff'));
    }

    public function deleteStaff(User $user)
    {
        $user->delete();

        session()->flash('success', 'Staff deleted successfully.');

        return redirect(route('staff'));
    }

    public function deleteCustomer(User $user)
    {
        $count_1 = Quotation::where('user_id', '=', $user->id)->count();
        $count_2 = PurchaseLog::where('user_id', '=', $user->id)->count();
        if($count_1 > 0 || $count_2 >0){
            session()->flash('danger', 'Customer cannot be deleted! There are products/requests under this customer!');

            return redirect(route('customer'));
        }

        $user->delete();

        session()->flash('success', 'Customer deleted successfully.');

        return redirect(route('customer'));
    }

    public function resetPassword(User $user)
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);

        $user->update([
            'password' => Hash::make($password)
        ]);

        session()->flash('success', 'Customer new password is '.$password);

        return redirect(route('customer.edit', $user->id));
    }
}
