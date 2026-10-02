<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

use Razorpay\Api\Api;
use Session;

class PaymentController extends Controller
{
    public function payments_list(){
        $data['title']='Payments List';
        $data['orders']=Order::get();
        return view('admin.pages.payments.payments_list',$data);
    }

    public function payments_add(){
        $data['title']='Payments add';
        return view('admin.pages.payments.payments_add',$data);
    }


    public function createOrder()
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'order_'.rand(),
            'amount' => 1000 * 100, // Amount in paise (INR 10)
            'currency' => 'INR',
            'payment_capture' => 1 // Auto capture
        ]);

        return view('razorpay-payment', ['order' => $order]);
    }

    public function handlePayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if ($payment->status == 'captured') {
            return response()->json(['message' => 'Payment successful!'], 200);
        }

        return response()->json(['message' => 'Payment failed!'], 400);
    }

}
