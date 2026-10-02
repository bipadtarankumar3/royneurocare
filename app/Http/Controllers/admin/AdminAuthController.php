<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\CheckInCheckout;
use App\Models\Patient;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function login(){
        return view('admin.Auth.login');
    }
    public function backToAdmin(){
       $user=User::where('email',Session::get('email'))->first();
       Auth::login($user);
       return redirect('admin/dashboard'); 
    }
    public function adminLoginAction(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if(Auth::user()->user_type=="admin"){
                return redirect('admin/dashboard'); 
            }else{
                 $request->session()->flash('success', 'Login Success');
                return redirect('vendor/dashboard');  
            }
               
           
        } else {
            $request->session()->flash('error', 'You have entered wrong Email or Password.');
            return redirect()->back();
        }
    }

    public function forgotPassword(){
        return view('admin.Auth.forgotPassword');
    }



    public function adminForgotAction(Request $request)
    {
        // Validate incoming email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Email not found or invalid.'], 404);
        }

        // Find user
        $user = User::where('email', $request->email)->first();

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        $otpExpiry = Carbon::now()->addMinutes(10);

        // Save OTP and expiry to user record
        $user->otp = $otp;
        $user->otp_expires_at = $otpExpiry;
        $user->save();

        // Send OTP via email
        // Mail::to($user->email)->send(new \App\Mail\UserForgotOtpMail($user, $otp));

        return response()->json(['message' => 'OTP sent to your email.']);
    }


    public function dashboard(){

        $data['client']=User::where('user_type','client')->count();
        $data['new_user']=User::where('status','pending')->count();

        $data['patient_list']=Patient::whereDate('created_at',date('Y-m-d'))->get();
        $today = Carbon::today();

        // Fetch orders for each date
        $data['today_orders'] = Order::join('patients', 'patients.id', '=', 'orders.patient_id')
        ->join('time_slots', 'time_slots.id', '=', 'orders.time_slot_id')
        ->select('orders.*', 'patients.first_name as patient_name', 'time_slots.from_time', 'time_slots.to_time')
        ->whereDate('booking_date', $today)->get();

        $data['patient']=Patient::count();
        $data['booking']=Order::count();

        $data['cancelled_booking_lists']=Order::join('patients', 'patients.id', '=', 'orders.patient_id')
        ->join('time_slots', 'time_slots.id', '=', 'orders.time_slot_id')
        ->select('orders.*', 'patients.first_name as patient_name', 'time_slots.from_time', 'time_slots.to_time')
        ->where('orders.status','cancelled')
        ->orderBy('orders.id','desc')
        ->limit(10)
        ->get();

        $data['cancelled_booking']=Order::where('status','cancelled')->count();
        $data['total_payments']=Order::where('status','confirmed')->sum('total_amount');

        $data['today_patient']=Patient::whereDate('created_at',date('Y-m-d'))->count();
        $data['today_booking']=Order::whereDate('booking_date',date('Y-m-d'))->count();
        $data['today_total_payments']=Order::whereDate('booking_date',date('Y-m-d'))->where('status','confirmed')->sum('total_amount');
        $data['today_cancelled_booking']=Order::whereDate('booking_date',date('Y-m-d'))->where('status','cancelled')->count();


        // $data['CheckInCheckout']=CheckInCheckout::where('ckn_in_out_status','in')->where('ckn_date',date('Y-m-d'))->count();
        // $data['CheckInCheckoutList']=CheckInCheckout::
        // select('check_in_checkouts.*','users.name','users.phone','users.email')
        // ->join('users','users.id','=','check_in_checkouts.ckn_user_id')
        // ->where('ckn_in_out_status','in')
        
        // ->where('ckn_date',date('Y-m-d'))
        // ->get();

        return view('admin.pages.dashboard.dashboard',$data);
    }
    public function profile(){
        return view('admin.auth.profile');
    }
    public function logout(Request $request){
        Auth::logout();


     $request->session()->flash('error','loged out');
     return redirect('login');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

 

}
