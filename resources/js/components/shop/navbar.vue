<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <img src='/svg/happy-shop-bag.png' style="height:40px; ">
           
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>
</template>


<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
