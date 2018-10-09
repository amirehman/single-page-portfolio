<template>
    <aside class="menu m-t-30">
        <ul class="menu-list">
            <li><a class="is-active">Dashboard</a></li>
        </ul>
        <p class="menu-label">Projects</p>
        <ul class="menu-list">
            <li>
                <router-link to="/me/projects">All Projects</router-link>
                <ul>
                    <li><router-link to="/me/projects/new">New</router-link></li>
                </ul>
            </li>
        </ul>
        <ul class="menu-list">
            <li><router-link to="/me/elements">Elements</router-link></li>
            <li><router-link to="/me/experties">Experties</router-link></li>
            <li><router-link to="/me/experiences">Experiences</router-link>
                <ul>
                    <li><router-link to="/me/experience/create">New</router-link></li>
                </ul>
            </li>
            <li><router-link to="/me/education">Education</router-link></li>
            <li><router-link to="/me/about">About</router-link></li>
            <li><router-link to="/me/general">General Setting</router-link></li>

        </ul>
        <ul class="menu-list">
            <router-link :to="login.link">{{login.name}}</router-link>
        </ul>
        
    </aside>
</template>

<script>
    export default {
    
        data() {
            return {
                login: {
                    name: "Login",
                    link: "/me/login"
                }
            }
        },
    
        created() {
            if (User.loggedIn()) {
                this.login.name = "Logout"
                this.login.link = "/me/logout"
            }
        },
    
    }
</script>

<style>
    
</style>
