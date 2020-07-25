<template>
    <div class="login-box">
        <div class="login-logo">
            <router-link :to="{name:'login'}">
                <b>Iniciar Sesion</b>
            </router-link>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresa tus credenciales para inicia sesion</p>

                <form method="post">
                    <div class="input-group mb-3">
                    <input type="email" @keyup.enter="login" v-model="fillLogin.cEmail" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" @keyup.enter="login" v-model="fillLogin.cContrasena" class="form-control" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="row">
                    <div class="col-md-12">
                        <span v-if="error">
                            <div v-for="(e, index) in mensajeError" :key="index" v-text="e" class="callout callout-danger"></div>
                        </span>
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <button class="btn btn-flat btn-block btn-danger" @click.prevent="login" v-loading.fullscreen.lock="fullscreenLoading">
                     Iniciar sesion
                    </button>
                </div>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            fillLogin: {
                cEmail: '',
                cContrasena: ''
            },
            fullscreenLoading: false,
            error : 0,
            mensajeError:[]
        }
    },
    methods: {
        login(){
            if (this.validarLogin()){
                return;
            }
            this.fullscreenLoading = true;
            var url = '/authenticate/login'
            axios.post(url, {
                    'cEmail' : this.fillLogin.cEmail,
                    'cContrasena' : this.fillLogin.cContrasena
            }).then(response => {
                console.log(response.data)
                if(response.data.code == 401){
                    this.loginFailed();
                }
                if(response.data.code == 200){
                    
                    this.loginSuccess();
                }
                this.fullscreenLoading = false;
            })
        },
        validarLogin(){
            this.error = 0;
            this.mensajeError = [];

            if(!this.fillLogin.cEmail){
                this.mensajeError.push('El correo electronico es un campo obligatorio')
            }
            if(!this.fillLogin.cContrasena){
                this.mensajeError.push('La contraseña es un campo obligatorio')
            }
            if(this.mensajeError.length){
                this.error = 1;
            }
            return this.error;
        },
        loginFailed(){
            this.error = 0;
            this.mensajeError = [];
            this.mensajeError.push('Estas credenciales no coinciden con nuestros registros');
            this.fillLogin.cContrasena = '';
            if(this.mensajeError.length){
                this.error = 1;
            }
            return this.error;
        },
        loginSuccess(){
            this.$router.push({name: 'dashboard.index'})
                location.reload();
        }
    },

}
</script>

<style>

</style>