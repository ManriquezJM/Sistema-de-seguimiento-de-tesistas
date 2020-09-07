<template>
    <div class="login-box">
        <div class="login-logo">
            <router-link :to="{name:'login'}">
                <b>Recuperar contraseña</b>
            </router-link>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"></p>

                <div class="alert alert-primary">
                    <form v-on:submit.prevent="sendToken">
                        <div class="form-group">
                            <label>1. Ingresa tu Correo</label>
                            <input type="text" class="form-control" v-bind="{'is-invalid': errorEmail, 'is-valid': infoEmail}" placeholder="Correo" v-model="email">
                            <div class="invalid-feedback">{{errorEmail}}</div>
                            <div class="invalid-feedback">{{infoEmail}}</div>
                            <button class="btn btn-primary">Enviar codigo a mi correo</button>
                        </div>
                    </form>
                </div>

                <div class="alert alert-secondary">
                    <form v-on:submit.prevent="validateToken">
                        <div class="form-group">
                            <label>2. Ingresa el codigo recibido</label>
                            <input type="text" class="form-control" v-bind:class="{ 'is-invalid:': errorToken, 'is-valid': infoToken}" placeholder="codigo" v-model="token">
                            <div class="invalid-feedback">
                                {{errorToken}}
                            </div>
                            <div class="invalid-feedback">
                                {{infoToken}}
                            </div>
                            <button type="submit" class="btn btn-secondary">Validar Codigo</button>
                        </div>
                    </form>
                </div>

                <div class="alert alert-success" v-if="tokenValid">
                    <form v-on:submit.prevent="changePassword">
                        <div class="form-group">
                            <label>3. Ingresa tu nueva contraseña</label>
                            <input 
                            type="text" 
                            class="form-control"
                            v-model="newPassword"
                            v-bind:class="{ 'is-invalid': errorNewPassword}" 
                            placeholder="nueva contraseña">
                            <div class="invalid-feedback">
                                {{errorNewPassword}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Repetir Contraseña</label>
                            <input 
                            type="text" 
                            class="form-control"
                            v-model="passwordAgain"
                            v-bind:class="{ 'is-invalid': errorPasswordAgain}" 
                            placeholder="repetir contraseña">
                            <div class="invalid-feedback">
                                {{errorPasswordAgain}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"> Cambiar Contraseña</button>
                    </form>
                </div>
                <!--
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
                <p class="mb-0">
                    <router-link :to="{name:'registro'}">
                        <b>Registrarme como alumno</b>
                    </router-link>
                </p>
                <p class="mb-0">
                    <router-link :to="{name:'registro'}">
                        <b>Recuperar contraseña</b>
                    </router-link>
                </p>
                
                -->
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            
            email: '',
            errorEmail: null,
            infoEmail: null,
            token: '',
            errorToken: null,
            infoToken: null,
            newPassword: '',
            errorNewPassword: null,
            passwordAgain: '',
            errorPasswordAgain: null,
            tokenValid: false,
            id_user: null,
                
        }
    },
    methods: {
        sendToken(){
            this.errorEmail = null;

            if(!this.email){
                this.errorEmail = 'debe ingresar su correo';
            }
            if(!this.errorEmail){
                const data = {
                    email: this.email
                }
                /*this.req.post('sendToken', data).then(() => {
                    this.infoEmail = 'Correo enviado';
                })*/
                var url = '/passrecovery/sendToken'
                axios.post(url, {
                    'email' : this.email,
                    
            }).then(() => {
                    this.infoEmail = 'Correo enviado';
                }).catch(error => {
                    this.errorEmail = error.response.data.error;
                });
            }
        },
        validateToken(){
            this.errorToken = null;

            if(!this.token){
                this.errorToken = 'El codigo es requerido.';
            }
            if(!this.errorToken){
                const data = {
                    token: this.token
                }
                /*this.app.req.post('validateToken', data)*/
                var url = '/passrecovery/validateToken'
                axios.post(url, {
                    'token' : this.token,
                }).then(response => {
                    if(response.data.id_user){
                        this.tokenValid = true;
                        this.infoToken = "El codigo es valido"
                        this.id_user = response.data.id_user;
                    }
                }).catch(error => {
                    thi.errorToken = error.response.data.error;
                })
            }
        },
        changePassword(){
            this.errorNewPassword = null;
            this.errorPasswordAgain = null;

            if(!this.newPassword){
                this.errorNewPassword = "La contraseña es requerida.";
            }
            if(!this.passwordAgain){
                this.errorPasswordAgain = "Falta confirmar la contraseña";
            }
            if(this.newPassword !== this.passwordAgain){
                this.errorPasswordAgain = "Las contraseñas no coinciden";
            }
            if(!this.errorNewPassword && !this.errorPasswordAgain){
                var url = '/passrecovery/resetPassword'
                axios.post(url, {
                    'password': this.newPassword,
                    'id_user': this.id_user
                }).then(() => {
                    this.$router.push('/login');
                })
            }
        },

    },

}
</script>

<style>

</style>