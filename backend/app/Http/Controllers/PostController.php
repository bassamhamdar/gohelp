<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Donation;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('organization')->get();
        return response()->json([
            'success'=>true,
            'message'=> 'post retreived successfully',
            'data'=> $posts,
        ], 200);
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
    public function store(StorePostRequest $request)
    {
        $inputs = $request->validated();
        $post = new Post();
        $post->fill($inputs);
        $post->save();
        return response()->json([
            'status'=>200,
            'success'=>true,
            'message'=>'Post created successfully',
            'data'=>$post
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
    public function update(UpdatePostRequest $request, $id)
    {
        $inputs = $request->validated();
        $post = Post::find($id);
        if($post){
            $post->update($inputs);
            return response()->json([
                'status'=>200,
                'success'=>true,
                'message'=>'Post updated successfully',
                'data'=>$post
            ]);
        }
        return response()->json([
            'status'=>200,
            'success'=>false,
            'message'=>'Post not found',
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
    
    public function DonationsOnPosts($org_id){
        $posts = Post::where('org_id', $org_id)->with('donation')->get();
        return response()->json([
            'success'=>true,
            'message'=>'donations on posts for your organization retreived successfully',
            'data'=> $posts,
        ]);
        
    }

    public function donationOnSpecificPost($post_id){
        $donation = Donation::where('post_id', $post_id)->get();
        return response()->json([
            'success'=>true,
            'message'=>'donations on this post retreived successfully',
            'data'=> $donation,
        ]);
    }

    public function acceptDonation($id){
        $donation = Donation::find($id);
        $donation->status = 1;
        $donation->save();
        return response()->json([
            'success'=> true,
            'message'=> 'donation accepted'
        ]);
    }
}
