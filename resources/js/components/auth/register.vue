<template>
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <form method="POST" action="/register-user" enctype='multipart/form-data'>
                        <div class="card-body">
                            <div class="form-group row">
                                <input type="hidden" name="_token" :value="csrf"> 
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{'Name'}}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required  autocomplete="name" autofocus ref='name'>
                                    <span class="invalid-det" role="alert" ref='namemsg'></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{'E-Mail Address'}}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" ref='email'>
                                    <span class="invalid-det" role="alert" ref='emailmsg'></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{'Password'}}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password"  ref='pwd'>
                                    <span class="invalid-det" role="alert" ref='pwdmsg'></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{'Confirm Password'}}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" ref='confpwd'>
                                    <span class="invalid-det" role="alert" ref='confpwdmsg'></span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" @click="validateRegister()">
                                        {{'Register'}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            errmsg: {
                type: String
            }
        }, 
        mounted () { 
            // Do something useful with the data in the template
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods:{  
            validateRegister(){
                let name        = this.$refs.name.value;
                let email       = this.$refs.email.value;
                let pwd         = this.$refs.pwd.value;
                let confpwd     = this.$refs.confpwd.value;

                var err = 0;
                if(!name) {
                    this.$refs.namemsg.innerHTML = '<strong>Name is required</strong>';
                    err = 1;
                }
                if(!email) {
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
                if (!confpwd) {
                    this.$refs.confpwdmsg.innerHTML = '<strong>Confirm Password</strong>';
                    err = 1;
                }else{
                    if(pwd != confpwd){
                        this.$refs.confpwdmsg.innerHTML = '<strong>Password and Confirm Password should match</strong>';
                        err = 1;
                    }
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