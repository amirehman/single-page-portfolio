<template>
    <div>
    
        <nav class="container nofront-nav">
            <h4 class="has-text-grey is-size-3"><router-link to="/about"><span>Amir Rehman</span></router-link>
                <!-- <small class="is-size-7 has-text-grey">Full Stack Developer</small> -->
                <a @click="$router.go(-1)" class="is-size-7 has-text-grey is-pulled-right">Go Back ↵</a>
                <router-link v-if="loginStatus" class="is-size-7 has-text-grey is-pulled-right m-r-50" to="/me/dashboard">Dashboard</router-link>
                <router-link v-if="loginStatus" class="is-size-7 has-text-grey is-pulled-right m-r-50" to="/me/logout">Logout</router-link>
            </h4>
        </nav>
    
    </div>
</template>



<script>
    export default {
    
        data() {
            return {
                loginStatus: false
            }
        },
    
        created() {
            if (User.loggedIn()) {
                this.loginStatus = true
            }else{
                this.loggedIn = false
            }
            
        },
    
    }
</script>

<style>
    
</style>
