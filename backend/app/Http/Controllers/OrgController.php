<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\activity;
use App\Http\Requests\StoreOrgRequest;
use App\Http\Requests\UpdateOrgRequest;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org = Organization::with('activity')->paginate(5);
        return response()->json([
            "status"=>200,
            "success"=> true,
            "message" => "Organizations has been retreived succesfully",
            "data"=> $org,
            
        ]);
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
    public function store(StoreOrgRequest $request)
    {   
        $inputs = $request->validated();
        $org = new Organization();
        $org->fill($inputs);
        $org->save();
        return response()->json([
            "status"=>200,
            "success"=> true,
            "message" => "you have been registered! Your profile will be reviewed",
            "data"=> $org
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
        $org = Organization::with('activity')->find($id);
        if($org){
            return response()->json([
                "status"=>200,
                "success"=> true,
                "message" => "organization retreived successfully",
                "data"=> $org
            ]);
        }
        return response()->json([
            "status"=>200,
            "success"=> false,
            "message" => "Not found",
        ]);

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
    public function update(UpdateOrgRequest $StoreRequest, $id)
    {
        $inputs = $StoreRequest->validated();
        $org = Organization::find($id);
        if($org){
            $org->fill($inputs);
            $org->update();
            return response()->json([
                "status"=>200,
                "success"=> true,
                "message" => "Updated successfully",
                
            ]);
        }
        return response()->json([
            "status"=>200,
            "success"=> false,
            "message" => "Not found",
            
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
        $org = Organization::find($id);
        if($org){
            $org->delete();
            return response()->json([
                'status' => 200,
                'success'=> true,
                'message' => 'deleted succesfully',
            ]);
        }
        return response()->json([
            'status' => 200,
            'success'=> false,
            'message' => 'failed to delete',
        ]);


    }
}
