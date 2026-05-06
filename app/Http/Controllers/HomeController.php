<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
    public function dashboard()
    {
        $cardCount = [];
        $cardCount['totalCustomers'] = Customer::count();
        $cardCount['totalStocks'] = Stock::count();
        // $cardCount['totalDrivers'] = Driver::count();
        // $today = Carbon::today();
        // $cardCount['todayCashPayment'] = Cash::whereDate('created_at', $today)->where('transaction_type', 'Cash Payment')->sum('amount');
        // $cardCount['todayCashReceive'] = Cash::whereDate('created_at', $today)->where('transaction_type', 'Cash Receive')->sum('amount');
        return view('admin.dashboard', compact('cardCount'));
    }

    public function changePassword() {
        return view('admin.change_password');
    }
    public function changePasswordPost(Request $request) {
        $user = auth()->user();
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'new_password' => 'required',
        ]);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Password changed successfully.');
    }
}
