<? php 
     function currentMonth_user(){

        $id = Auth::user()->id;
        $query = DB::table('food_order')
        ->join('food','food.id','=','food_order.food_id')
        ->join('orders','orders.id','=','food_order.order_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('food_order.order_id', DB::raw('SUM(food.price) as total'),'orders.created_at','users.id','food.name','users.lastname','users.firstname')
        ->groupBy('order_id','orders.created_at','users.lastname','users.firstname','users.id','food.name')
        ->where('users.id',$id)
        ->where('food.price','>','0')
        ->whereMonth('food_order.created_at',date('m'))->get();

         return view('reports.userReport',["query"=>$query]);
        
      
        
    } 
    ?>