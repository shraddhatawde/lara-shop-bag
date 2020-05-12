<template>
    <div class="container">      
        <div class="row justify-content-center">    
            <div class=" col-md-4" v-for="(product, product_id) in JSON.parse(products)" v-bind:key="product_id">               
                <div class="card card-body">  
                    <div class="col-md-12">                        
                        <img :src="product.img_path" style="height:200px;" class='w-100'> 
                    </div>
                    <div class="col-md-12 ">  
                        <span>{{product.description}}</span> <br/>  
                        <b>{{product.currency}}.{{product.price}}</b><br/>   
                        <span><button @click="addToCart(product_id)" class="btn btn-primary">Add to Cart</button></span>
                        <span><a class="btn btn-link" href="#" @click="addToWishlist(product_id)">Add to Wishlist</a></span>                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            products: {
                type: String,
                required: true,
            }
        },
        mounted () { 
            // Do something useful with the data in the template
            //console.dir(this.products);
        },
        methods:{
            addToCart(pid){
                fetch(`add-cart/${pid}`, {                    
                    method: 'get'
                })
                .then(res => res.json())
                .then(data => {      
                    alert('Added to Cart');     
                    //let myresponse = res.json();         
                    //console.dir(myresponse);                    
                    /*if(myresponse == 'nologin'){                        
                        alert('Please Login to add product to cart');
                    }else{
                        alert('Added to Cart');
                    }*/
                })
                .catch(err => console.log(err));     
            },
            
            addToWishlist(pid){
                fetch(`save-wishlist/${pid}`, {                    
                    method: 'get'
                })
                .then(res => res.json())
                .then(data => {        
                     alert('Added to Wishlist');            
                    /*if(res.json() == 'nologin'){                        
                        alert('Please Login to add product to wishlist');
                    }else{
                        alert('Added to Wishlist');
                    }*/
                })
                .catch(err => console.log(err));                
            },
        }
    }
    
</script>
