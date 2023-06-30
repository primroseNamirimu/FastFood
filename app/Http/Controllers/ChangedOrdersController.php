<?php

namespace App\Http\Controllers;

use App\Models\NotificationChangedOrders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangedOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changedOrders(Request $request){
        $changedOrder = NotificationChangedOrders::create([
            'user_id' =>Auth::user()->id,
            'changedOrders'  => $request->changedOrder,
        ]);
        User::find(Auth::user()->id)->notify(new NotificationChangedOrders($changedOrder->changedOrders));

        return redirect()->back()->with('status','Your order was changed!');
    }
}
