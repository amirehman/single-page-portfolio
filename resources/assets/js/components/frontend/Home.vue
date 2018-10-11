<template>
    <div>
    
        <section class="front-cover">
            <div class="hero is-fullheight">
                <div class="about-info">
    
                    <div class="front-cards about-name-card">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by4">
                                    <img src="images/about.jpg" alt="Placeholder image">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="front-cards about-compnay-card">
                        <div class="card">
                            <figure class="image is-4by4">
                                <img src="http://icon-ad.com/wp-content/uploads/2018/04/da65a256168033.59a3dbf9a612a.jpg" alt="Placeholder image">
                            </figure>
                        </div>
                    </div>
                    <div class="front-cards about-work-card">
                        <div class="card">
                            <div class="card-content">
                                <h4>I have a pretty good portfolio</h4>
                                <p>just check it out</p>
                            </div>
                        </div>
                    </div>
    
    
    
                    <div class="intro dynamic-content" @click="handleClicks" v-html="general.intro"></div>
    
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
                        <span class="has-text-grey"> or email me direct at
                            <a class="has-text-weight-semibold" href="mailto:hi@amirrehman.com">{{profile.email}}</a>
                        </span>
                    </div>
                </div>
    
                <div class="corner-lines"></div>
    
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
                profile: {}
    
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
            }, 500)
        },
        methods: {
            applyTextEdit() {
    
            },
            getData() {
                axios.get(`/api/general`)
                    .then(response => {
                        this.general = response.data.data
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
