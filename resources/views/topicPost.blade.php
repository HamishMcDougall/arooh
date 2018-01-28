<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aroohyay</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

        <style>

        </style>
    </head>
    <body>



            <div class="content">


              <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a></p>
          @endif
        @endforeach
      </div> <!-- end .flash-message -->

@foreach ($topicCollection as $topic)
{{$topic->topic}}
{{$topic->id}}
@endforeach


              @foreach ($posts as $post)
            <h3>{{$post->post}}</h3> <h6>Votes:{{$post->votes}}</h6>

  <form action="/upvote" method="POST" role="vote">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-default">upvote</button>
      <input  name="postId" type="hidden" value="{{$post->id}}">
  </form>


  <form action="/downvote" method="POST" role="vote">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-default">downvote</button>
        <input  name="postId" type="hidden" value="{{$post->id}}">
  </form>

            @endforeach



@if(Auth::check())
            <div class="panel panel-default">
              <div class="panel-heading">Add your expert opinion</div>
              <div class="panel-body">


                <form action="/addPost" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputEmail1">Write your answer</label>
                      <textarea class="form-control" rows="3" name="TextAnswer" maxlength="300"></textarea>
                      <input  name="topicId" type="hidden" value="{{$topic->id}}">
                    </div>


                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>


              </div>
            </div>

@endif
            </div>



    </body>
</html>
