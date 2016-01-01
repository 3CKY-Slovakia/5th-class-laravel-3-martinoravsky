@extends('layouts.blog')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>Zoznam registrovanych pouzivatelov: </h5>
                        @foreach ($users as $user)
                            <p>{{ $user->name}}</p>
                        @endforeach

        </div>
    </div>
    </div>
        </div>
    </div>
@endsection
