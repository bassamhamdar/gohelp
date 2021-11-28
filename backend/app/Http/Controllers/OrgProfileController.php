<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrgProfile;
use App\Http\Requests\UpdateOrgProfileRequest;

class OrgProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = OrgProfile::all();
        return $profile;
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
        $profile = OrgProfile::with('organization')->find($id);
        return response()->json([
            'success'=>true,
            'message'=>'profile retreived successfully',
            'data'=> $profile,
        ],200);

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
    public function update(UpdateOrgProfileRequest $request, $id)
    {       $inputs = $request->validated();
            $profile =  OrgProfile::find($id);
            if($profile){
                $profile->update($inputs);
                return response()->json([
                    'status'=>200,
                    'success'=>true,
                    'message'=>'profile updated successfulyy'
                ]);
            }
            return response()->json([
                'status'=>200,
                'success'=>false,
                'message'=>'profile not found'
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
        //
    }
}
