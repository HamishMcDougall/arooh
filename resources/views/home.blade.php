@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="content">
                        <div class="title m-b-md">
                            Aroohyay
                        </div>
                        <div class="container">


                        <form action="/search" method="POST" role="search">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" name="q"
                                    placeholder="Search topics"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>

                          </div>

                        <div class="container">
                            @if(isset($details))
                                <p> Topics for your search of <b> {{ $query }} </b> are :</p>
                                    @foreach($details as $topic)

                                        <div class="">
                                      <a href="topic/{{$topic->topic}}">
                                          {{$topic->topic}}
                                      </a>
                                        </div>

                                    @endforeach

                                    @elseif(isset($message))
                                       <p>{{ $message}}
                                      <b> {{ $query }} </b> ?</p>


                                      <form action="/addTopic" method="POST" role="search">
                                          {{ csrf_field() }}
                                          <div class="form-group">
                                            <input  name="newTopic" type="hidden" value="{{ $query }}">
                                              <button type="submit" class="btn btn-default">Yes</button>
                                          </div>



                                        </form>

                            @endif

                        </div>

                    </div>



                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
