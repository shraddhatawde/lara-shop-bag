@extends('firebase_auth.layout')

@section('content')
    <login :errmsg='@json($errmsg)'></login>
@endsection
