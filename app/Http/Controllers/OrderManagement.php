<?php

namespace App\Http\Controllers;

use App\Models\food_order;
use Illuminate\Http\Request;
use App\Models\order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderManagement extends Controller
{

    public function index()
    {

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
     *use App\Models\order;
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function destroy($id)
    {
//        $query = DB::table('food_order')
//            ->where('food_id','=',$id)
//            ->delete();
        $d = DB::table('fod_id')->select('food_order.*')->where("food_id",'=',$id)->get();
        dd($d);

        return redirect()->route('admin.home')
                        ->with('success','order deleted successfully');
    }
}
