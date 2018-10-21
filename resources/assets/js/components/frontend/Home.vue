<template>
    <div>
    
        <section class="front-cover" :style="{ 'background-image': 'url(' + baseURL + 'assets/' + bodyimage + ')'}">
            <div class="hero is-fullheight">


                <div class="about-info">

                    <ball-pulse-sync-loader v-if="loading" color="#e67e22" size="8px"></ball-pulse-sync-loader>
                    <h2 v-cloak class="intro info dynamic-content" @click="handleClicks" v-html="general.intro"></h2>

                    <div class="about-photo">
                        <img :src="`${baseURL}${general.dp}`" alt="image">
                    </div>


                    <div class="social">
                    
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
                        <a class="has-text-grey"> | </a>
                        <a  class="has-text-grey email" href="mailto:hi@amirr.net" >
                            hi@amirr.net
                        </a>
                    </div>

                    <div class="menu front">
                        <div class="menu-button">
                            <div class="fa fa-bars" v-if="!NavIsActive" @click="onNavBarClick"></div>
                            <div class="fa fa-close"  v-if="NavIsActive" @click="onNavBarClose"></div>
                            <div class="menu-items" v-bind:class="{ active: NavIsActive}">
                                <div class="items"><router-link to="/about">About</router-link></div>
                                <div class="items"><router-link to="/work">Work</router-link></div>
                                <div class="items"><router-link to="/contact">Contact</router-link></div>
                            </div>
                        </div>




                    </div>

                </div>            
                
    
            </div>
        </section>
    
        <section class="">
        </section>
    
    
    </div>
</template>


<script>
    export default {
        data() {
            return {
                general: {
                    image: ""
                },
                profile: {},
                loading: true,
                baseURL: "http://45.77.65.13/images/",
                bodyimage: 'round.png',
                NavIsActive: false
            }
        },
        created() {
            this.getData();
    
        },
        mounted() {
            setTimeout(() => {
                const targets = document.querySelectorAll('a:not(.nottarget)');
                targets.forEach(e => {
                    e.removeAttribute('target')
                })
            }, 900)
        },
        methods: {
            onNavBarClick () {
                this.NavIsActive = true
            },
            onNavBarClose () {
                this.NavIsActive = false
            },
            applyTextEdit() {
            },
            getData() {
                axios.get(`/api/general`)
                    .then(response => {
                        this.general = response.data.data
                        this.loading = false
                    });
                axios.get(`/api/about`)
                    .then(response => {
                        this.profile = response.data.data
                    });
            },
            handleClicks($event) {
                const {
                    target
                } = $event
                if (target && target.matches(".dynamic-content a:not([href*='://'])") && target.href) {
                    const {
                        altKey,
                        ctrlKey,
                        metaKey,
                        shiftKey,
                        button,
                        defaultPrevented
                    } = $event
                    // don't handle with control keys
                    if (metaKey || altKey || ctrlKey || shiftKey) return
                    // don't handle when preventDefault called
                    if (defaultPrevented) return
                    // don't handle right clicks
                    if (button !== undefined && button !== 0) return
                    // don't handle if `target="_blank"`
                    if (target && target.getAttribute) {
                        const linkTarget = target.getAttribute('target')
                        if (/\b_blank\b/i.test(linkTarget)) return
                    }
                    // don't handle same page links/anchors
                    const url = new URL(target.href)
                    const to = url.pathname
                    if (window.location.pathname !== to && $event.preventDefault) {
                        $event.preventDefault()
                        this.$router.push(to)
                    }
                }
            }
        }
    
    }
</script>


<style scopped>
    
</style>