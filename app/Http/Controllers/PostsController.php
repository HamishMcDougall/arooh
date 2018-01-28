<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Posts;
use App\Topics;
use Illuminate\Http\Request;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic)
    {
      // returns the full topic object
      $topicCollection =  DB::table('topics')->where('topic', '=', $topic)->get();
      //returns only the topic ID used to search in posts
      $topicCollection_id = DB::table('topics')->where('topic', '=', $topic)->value('id');
      //return all posts with the topic id
      $posts = DB::table('posts')->where('topic_id', '=', $topicCollection_id)->orderBy('votes', 'desc')->get();
        return view('topicPost')->with('posts',$posts)->with('topicCollection',$topicCollection);

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
    public function store(Request $request)
    {

          $currentUserId = Auth::id();

      $postText = $request->TextAnswer;
      $topic_id = $request->topicId;
      $createdAt = new \DateTime();

      DB::table('posts')->insert([
            'post' => $postText,
            'topic_id' => $topic_id,
            'votes' => 0,
            'created_at' => $createdAt,
            'user_id' => $currentUserId
        ]);

        return back()->withInput();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upvote(Request $request)

    {
        $updatedAt = new \DateTime();

        $id = $request->postId;
        $currentVotes = DB::table('posts')->where('id', '=', $id)->value('votes');
        $newVotetotal = $currentVotes + 1;

        if (Auth::check()) {
          $newVotesUpdate = DB::table('posts')
              ->where('id', '=', $id)
              ->update([
                'votes' => $newVotetotal,
                'updated_at' => $updatedAt
              ]);

              return back()->withInput();
        }

        $request->session()->flash('alert-warning', 'You must be login in to vote!');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downvote(Request $request)
    {

      $updatedAt = new \DateTime();

      $currentUserId = Auth::id();

      $id = $request->postId;
      $currentVotes = DB::table('posts')->where('id', '=', $id)->value('votes');
      $newVotetotal = $currentVotes - 1;

      if (Auth::check()) {
        $newVotesUpdate = DB::table('posts')
            ->where('id', '=', $id)
            ->update([
              'votes' => $newVotetotal,
              'updated_at' => $updatedAt
            ]);

            return back()->withInput();
      }

      $request->session()->flash('alert-warning', 'You must be login in to vote!');
      return back();
    }
}
