<template>
  <transition name="slide-fade" mode="out-in">
            <router-view></router-view>
        </transition>
</template>

<script>
export default {
   mounted() {
            this.getRefrescarUsuarioAutenticado();
        },
        methods: {
            getRefrescarUsuarioAutenticado() {
                if (this.$router.currentRoute.name != 'login') {
                    var url = '/authenticate/getRefrescarUsuarioAutenticado'
                    axios.get(url).then(response => {
                    }).catch(error => {
                        if (error.response.status == 401) {
                          if(localStorage['authUser']){
                            this.$router.push({name: 'login'})
                            location.reload();
                            localStorage.clear();
                          }
                        }
                    })
                }
            },
        },
}
</script>

<style>

</style>