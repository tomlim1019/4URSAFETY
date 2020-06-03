<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function customerIndex()
    {
        $users = User::where('role', 'customer')->get();

        return view('user.customer')->with('customers', $users);
    }

    public function staffIndex()
    {
        $users = User::whereIn('role', ['admin', 'staff'])->get();

        return view('user.staff')->with('staffs', $users);
    }

    public function createStaff(Request $request)
    {
        $password = "4ursafety";

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

        session()->flash('success', 'Staff created successfully.');

        return redirect(route('staff'));
    }

    public function editCustomer(User $user)
    {
        return view('user.detail')->with('customer', $user);
    }

    public function editStaff(User $user)
    {
        return view('user.detail')->with('staff', $user);
    }
}
