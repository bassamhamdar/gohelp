<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::all();
        return response()->json([
            'success'=>true,
            'message'=>'users retrieved successfully',
            'data'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        $inputs = $request->validated();
        $org = new User();
        $org->fill($inputs);
        $org->save();
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
        $user = User::with('Request','Donation')->find($id);
        if(!$user){
            return response()->json([
                'success'=> false,
                'message'=> 'user not found'
            ], 200);
        }
        if($user->status == 0){
            return response()->json([
                "status"=>200,
                "success"=> false,
                "message" => "Sorry ! Your profile is being reviewed",
            ]);
        }
        return response()->json([
            "status"=>200,
            "success"=> true,
            "message" => "Your profile retrieved successfully",
            "data"=>$user,
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $inputs = $request->validated();
        $user = User::find($id);
        if($user){
            $user->fill($inputs);
            $user->save();
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
        //
    }
 

    public function login(LoginRequest $request)
    { 
        $credentials = $request->validated();
        $credentials = request(['email', 'password']);

        if (! $token = auth('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 200);
        }
        $user = User::where('email', request('email'))->get();
        return $this->respondWithToken($token, $user);
    }

    public function logout()
    {
        auth('user')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'success'=>true,
            'message'=>'Logged in successfully',
            'data'=>$user,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('user')->factory()->getTTL() * 60
        ],200);
    }

}
