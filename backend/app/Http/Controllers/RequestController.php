<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequestRequest;
use App\Models\UserRequest;

class RequestController extends Controller
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
    public function store(StoreRequestRequest $request)
    {
        $inputs = $request->validated();
        $req = new UserRequest();
        $req->fill($inputs);
        $req->save();
        return response()->json([
            'status'=>200,
            'success'=>true,
            'message'=>'Request had been sent successfully',
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

    public function helpRequests($org_id){
     
        $helpReq = UserRequest::where('org_id', $org_id)->where('isDonation', 0)->with('User')->get();

        if($helpReq){
            return response()->json([
                'success'=>true,
                'message'=> 'help requests retreived successfully',
                'data'=> $helpReq,
            ],200);

        }
        return response()->json([
            'success'=>false,
            'message'=> 'No help requests at the moment',
        ],200);
    }


    public function donationRequests($org_id){
     
        $donationReq = UserRequest::where('org_id', $org_id)->where('isDonation', 1)->with('User')->get();
      

        if(!$donationReq){
            return response()->json([
                'success'=>false,
                'message'=> 'No donation requests at the moment',
            ],200);
        }
        return response()->json([
            'success'=>true,
            'message'=> 'donation requests retreived successfully',
            'data'=> $donationReq,
        ],200);
    }

    public function acceptRequests($id){
        $req = UserRequest::find($id);
        $req->accepted = 1 ;
        $req->save();
        return response()->json([
            'success'=>true,
            'message'=>'request accepted'
        ]);
    }
    
}
