<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{'Login'}}</div>
                    <div class="card-body">        
                        <form method="POST" action="/login-verify" enctype='multipart/form-data'>       
                        <div class="form-group row">
                            <span class="invalid-det" role="alert" ref="errmsg"></span>
                        </div>            
                        <div class="form-group row">
                            <input type="hidden" name="_token" :value="csrf">   
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{'E-Mail Address'}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus ref="email">

                                <span class="invalid-det" role="alert" ref='emailmsg'></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{'Password'}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" ref="pwd">

                                <span class="invalid-det" role="alert" ref='pwdmsg'></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary" @click="validateLogin()">
                                    {{'Login'}}
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            errmsg: {
                type: String,
            }
        }, 
        mounted () { 
            // Do something useful with the data in the template
            //console.dir(this.products);
            console.dir('te = '+this.errmsg);
            if(this.errmsg){ console.log(this.errmsg);
                this.$refs.errmsg.innerHTML = this.errmsg;
            }
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods:{  
            validateLogin(){
                let email = this.$refs.email.value;
                let pwd   = this.$refs.pwd.value;
                //this.$refs.emailmsg.innerHTML = '';
                //this.$refs.password.innerHTML = '';
                var err = 0;
                if (!email) {
                    this.$refs.emailmsg.innerHTML = '<strong>Email is required</strong>';
                    err = 1;
                }else{
                    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    let emailval = re.test(email);
                    if(!emailval){
                        this.$refs.emailmsg.innerHTML = '<strong>Enter a valid email</strong>';
                        err = 1;
                    }
                }
                if (!pwd) {
                    this.$refs.pwdmsg.innerHTML = '<strong>Password is required</strong>';
                    err = 1;
                }
                
                if(err == 1){
                    return false;
                }            
            }, 
        }
    }
    
</script>

<style scoped>
    .invalid-det {
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #e3342f;
    }

</style>