<template>
    <div>
    
        <div class="menu normal">
            <div class="menu-button">
                <div class="fa fa-bars" v-if="!NavIsActive" @click="onNavBarClick"></div>
                <div class="fa fa-close" v-if="NavIsActive" @click="onNavBarClose"></div>
                <div class="menu-items" v-bind:class="{ active: NavIsActive}">
                    <div class="items">
                        <router-link to="/about">About</router-link>
                    </div>
                    <div class="items">
                        <router-link to="/work">Work</router-link>
                    </div>
                    <div class="items">
                        <router-link to="/contact">Contact</router-link>
                    </div>
                </div>
            </div>
        </div>
    
    
        <footer class="footer is-paddingless m-t-75">
            <div class="container">
                <div class="content">
                    <div class="getsocial">
                        <a class="gettitle">Get Social </a>
                        <a class="nottarget" :href="general.linkedin" target="_blank">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a class="nottarget" :href="general.github" target="_blank">
                            <i class="fa fa-github"></i>
                        </a>
                        <a class="nottarget" :href="general.stackoverflow" target="_blank">
                            <i class="fa fa-stack-overflow"></i>
                        </a>
                        <a class="nottarget" :href="general.instagram" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <a class="nottarget" :href="general.facebook" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <span> or email me direct at
                                                <a :href="profile.email">{{profile.email}}</a>
                                            </span>
                    </div>
    
                </div>
            </div>
        </footer>
    
    </div>
</template>


<script>
    export default {
        data() {
            return {
                profile: {},
                general: {},
                NavIsActive: false
            }
        },
        created() {
            axios.get(`/api/general`)
                .then(response => {
                    this.general = response.data.data
                });
            axios.get(`/api/about`)
                .then(response => {
                    this.profile = response.data.data
                });
        },
        methods: {
            onNavBarClick () {
                this.NavIsActive = true
            },
            onNavBarClose () {
                this.NavIsActive = false
            },
        }
    
    }
</script>