@extends('layouts.blog')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <br>
                    <div class="alert alert-danger" role="alert">You have reached maximum limit of articles.</div>

                    <form action="/">
                        <input type="submit" value="Go back">
                    </form>
                <br>

            </div>
        </div>
    </div>
@endsection