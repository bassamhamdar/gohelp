<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $inputs = $request->validated();
        $address = new Address();
        $address->fill($inputs);
        $address->save();
        return response()->json([
            'status'=>200,
            'success'=>true,
            'message'=>'Address has been added successfully',
            'data'=> $address,
        ]);
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
    public function update(UpdateAddressRequest $request, $id)
    {
        $inputs = $request->validated();
        $address = Address::find($id);
        if($address){
            $address->update($inputs);
            return response()->json([
                'status'=>200,
                'success'=>true,
                'message'=>'Address has been update successfully',
            ]);
    
        }
        return response()->json([
            'status'=>200,
            'success'=>false,
            'message'=>'Address not found',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        if($address){
            $address->delete();
            return response()->json([
                'status'=>200,
                'success'=>true,
                'message'=>'Address deleted successfully',
            ]);
    
        }
        return response()->json([
            'status'=>200,
            'success'=>false,
            'message'=>'Address not found',
        ]);
    }
}
