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

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

        <style>

        </style>
    </head>
    <body>



            <div class="content">


@foreach ($topicCollection as $topic)
{{$topic->topic}}
@endforeach


              @foreach ($posts as $post)
            <h3>{{$post->post}}</h3> <h6>Votes:{{$post->votes}}</h6>
            @endforeach

            </div>



    </body>
</html>
