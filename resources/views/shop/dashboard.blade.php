@extends('shop.shop_layout')

@section('content')
    @php
        //echo '<pre>'; print_r(json_encode($products));
    @endphp
   
    <dashboard :products='@json($products)'></dashboard>
@endsection



