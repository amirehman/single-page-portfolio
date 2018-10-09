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
    
                    <!--<h4>
                                                <span class="br heighlight">Hey there,</span>
                                                <span class="br">I'm
                                                    <a href="about.html" class="front-name">Amir Rehman!</a> a Pakistani full stack developer,</span>
                                                <span class="br">Specializing in building everything from small business sites to rich interactive web apps. Currently
                                                    working for
                                                    <a href="http://icon-ad.com">Icon Advertising LLC.</a>
                                                </span> Check out some of my
                                                <a href="work.html">latest work</a>. </h4>-->
                    <div class="social">
                        <a href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-github"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <span class="has-text-grey"> or write to
                                                    <a class="has-text-weight-semibold" href="mailto:hi@amirrehman.com">hi@amirrehman.com</a>
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
                }
    
            }
        },
        created() {
            this.getData();
    
        },
        mounted() {
            setTimeout(() => {
                const targets = document.querySelectorAll('a');
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
            },
            handleClicks($event) {
                const {
                    target
                } = $event
                // handle only links that occur inside the component and do not reference external resources
                if (target && target.matches(".dynamic-content a:not([href*='://'])") && target.href) {
                    // some sanity checks taken from vue-router:
                    // https://github.com/vuejs/vue-router/blob/dev/src/components/link.js#L106
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
