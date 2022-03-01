<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food;
use App\Models\food_order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\order;
use App\Models\User;


class OrderController extends Controller
{
   
    public function index()
    {
        $menuTable = food::all();
        $users = User::all();
        $combined = $menuTable->merge($users);
        
        
        if (auth::user()->is_admin == 1) {
           

            return view('adminBlades.order', ['menuTable' => $menuTable],['users' => $users]);
        }else{

            return view('userBlades.order', ['menuTable' => $menuTable]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
     //

    }

    public function createMenuItem(Request $request)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255', 'unique:food',
            'price' => 'required', 'numeric',
        ]);
        try {

            food::create($request->all());
            return redirect()->route('order.index')
    ->with('success','food added successfully.');
    
        } catch (\Throwable $th) {
            return redirect()->route('order.index')
    ->with('fail','Food already exists!! Search first before opting to create');
        }
 


   
   
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = $_POST['total'];
        $food_IDS = $_POST['food_ids'];
        $staff_IDS = $_POST['staff_name'];
        $staff_Name = $_POST['actual_staff_name'];
       
        if(Auth::user()->is_admin ==1 && $staff_IDS !== "" ){
            $userID = $staff_IDS;
            if ($total == null) {
    
                return redirect()->route('order.index')
                    ->with('danger', 'Order can not be empty');
    
            }
            else {
                $orderRecord = order::create(['user_id' => $userID]);
    
                $lastId = $orderRecord->id;
                $food_ids_string = json_decode($food_IDS, true);
    
                foreach ($food_ids_string as $value) {
                    echo($value);
    
    
                    $orderDetailsRecord = food_order::create(['order_id' => $lastId,
                        'food_id' => $value]);
    
                }
    
    
                if ($orderDetailsRecord) {
                    return redirect()->route('order.index')
                        ->with('success','Order for ' . $staff_Name .' was successfully recorded');
               
                }
                else {
                    return redirect()->route('order.index')
                        ->with('danger', 'Something went wrong');
                }
             }
    
           
        
    
        }else{

            $userID = Auth::user()->id;

            if ($total == null) {
    
                return redirect()->route('order.index')
                    ->with('danger', 'Order can not be empty');
    
            }
            else {
                $orderRecord = order::create(['user_id' => $userID]);
    
                $lastId = $orderRecord->id;
                $food_ids_string = json_decode($food_IDS, true);
    
                foreach ($food_ids_string as $value) {
                    echo($value);
    
    
                    $orderDetailsRecord = food_order::create(['order_id' => $lastId,
                        'food_id' => $value]);
    
                }
    
    
                if ($orderDetailsRecord) {
                    return redirect()->route('order.index')
                        ->with('success', 'Your Order was successfully recorded');
               
                }
                else {
                    return redirect()->route('order.index')
                        ->with('danger', 'Something went wrong');
                }
             }
    
           
        }
    
        }

      
    public function showMenuItems(){
        $menuTable = food::all();

        return view('adminBlades.menuDisplay', ['menuTable' => $menuTable]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
    // * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foodItem= food::find($id);
        return view('adminBlades.editMenu',compact('foodItem'),["foodItem"=>$foodItem]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //
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
    
        $foodItem = food::find($id);
        $foodItem->price = request('price');
        $foodItem->name = request('name');

        $request->validate([
            'name' => 'required','string', 'max:255', 'unique:food',
            'price' =>'required', 'numeric',
            
     ]);
     
        $foodItem->save();
        

        $foodItem ->update($request->all());
       
        return redirect()->route('order.index')
                        ->with('success','Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        food::find($id)->delete();
  
        return redirect()->route('order.index')
                        ->with('success','Food item deleted successfully');
    }
}
