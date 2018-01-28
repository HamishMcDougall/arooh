<?php
use App\User;
use App\Topics;
use Illuminate\Support\Facades\Input;

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::any('/search',function(){
    $q = Input::get('q');
    $topic = Topics::where('topic','LIKE','%'.$q.'%')->get();
    if(count($topic) > 0)
        return view('welcome')->withDetails($topic)->withQuery($q);
    else return view ('welcome')->withMessage('No topic found. Would you like to create one for the topic ')->withQuery($q);
});

Route::post('addTopic', 'TopicsController@store');



Route::get('topic/{topic}', 'PostsController@index');
Route::post('addPost', 'PostsController@store');


// upvote
Route::post('/upvote', 'PostsController@upvote');

// downvote
Route::post('/downvote', 'PostsController@downvote');
