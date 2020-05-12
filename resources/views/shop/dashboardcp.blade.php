@extends('shop.shop_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">  
                <div class="card-body">       
                    <div class="col-md-12">
                        <img src='/svg/handbag1.jpg' style="height:200px; ">   
                    </div>
                    <div class="col-md-12 ">  
                        <span>PARADOX (LABEL) Womens Hand Bag Ladies Purses Satchel Shoulder Bags</span> </br>  
                        <b>Rs.1500 </b></br>                                          
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add to Cart') }}
                        </button>
                        <a class="btn btn-link" href="#">
                            {{ __('Add to Wishlist') }}
                        </a>                    
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">  
                <div class="card-body">       
                    <div class="col-md-12">
                        <img src='/svg/watch1.jpg' style="height:200px; ">   
                    </div>
                    <div class="col-md-12 ">  
                        <span>Fetch Date & Time Analog White Dial Men’s & Boy's Watch fw1046</span> </br>  
                        <b>Rs.3000 </b></br>                                          
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add to Cart') }}
                        </button>
                        <a class="btn btn-link" href="#">
                            {{ __('Add to Wishlist') }}
                        </a>                    
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
