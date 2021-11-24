<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\OrgProfile;
use App\Models\activity;
use App\Http\Requests\StoreOrgRequest;
use App\Http\Requests\UpdateOrgRequest;
use App\Models\Address;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org = Organization::where('status', 1)->with('activity','orgProfile','address','request',)->paginate(5);
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
        $profile = new OrgProfile();
        $profile->fill($inputs);
        $address = new Address();
        $address->fill($inputs);
        $org->Orgprofile()->save($profile);
        $org->Address()->save($address);
        return response()->json([
            "status"=>200,
            "success"=> true,
            "message" => "you have been registered! Your profile will be reviewed",
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
        $org = Organization::with('activity','OrgProfile','Address','Request')->find($id);
        if($org){
            if($org->status == 0){
                return response()->json([
                    "status"=>200,
                    "success"=> false,
                    "message" => "Your profile is being reviewed",
                    
                ]);
            }
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
            $org->update($inputs);
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
            $org->OrgProfile()->delete();
            $org->Address()->delete();
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
