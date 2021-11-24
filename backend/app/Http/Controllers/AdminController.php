<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
class AdminController extends Controller
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
    public function store(Request $request)
    {
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function blockUser($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return response()->json([
            'status'=>200,
            'success'=>true,
            'message'=>'user is now blocked',
        ]);
    }

    public function organization($id){
        $org = Organization::find($id);
        if($org->status == 0){
            $org->status = 1;
            $org->save();
            return response()->json([
                'status'=>200,
                'succuss'=>true,
                'message'=>'Organization is now activated'
            ]);
        }
        $org->status = 0;
        $org->save();
        return response()->json([
            'status'=>200,
            'succuss'=>true,
            'message'=>'Organization  deactivated'
        ]);

    }
}
