<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="single-wrapper">
        <div class="container">
            <div class="columns">
                <div class="column is-8">
                    <div class="inner-wrapper">
                        <header class="single-header has-text-left">
                            <span class="is-marginless is-size-7 has-text-grey">Project</span>
                            <h3 class="is-marginless is-size-3">{{project.title}}</h3>
                            <p>{{project.detail}}</p>

                            <div class="single-elemets">
                                <h4 class="is-size-5">Elements Used In This Projects</h4>
                                <ul>
                                    <li class="button is-radiusless" v-for="element in elements">
                                        <a target="_blank" :href="`${element.link}`">{{element.name}}</a>
                                    </li>
                                </ul>
                            </div>
                        </header>
                        <hr>

                        <div class="single-body">
                            <ul>

                                <li v-for="page in pages">
                                    <span class="vline"></span>
                                    <h4 class="is-size-4 is-marginless">{{page.title}}</h4>
                                    <p class="is-size-6">{{page.detail}}</p>
                                    <template v-if="page.image">
                                        <img :src="`${baseURL}images/${page.image}`">
                                    </template>
                                </li>

                            </ul>
                        </div>
                    </div>


                    <div class="single-like has-text-centered">
                        <i class="fa fa-heart" title="git it a thumbs up"></i>
                        <span class="like-counter">34</span> 
                    </div>


                </div>
            </div>
        </div>
    </div>
    
        <footer-bottom></footer-bottom>
    
    </div>
</template>

<script>
    import footer from "./Footer";
    import navbar from "./TopNav";
    export default {
        data() {
            return {
                project: {},
                baseURL: "http://127.0.0.1:8000/",
                elements: {},
                pages: {}
    
            }
        },
        mounted() {
            this.getProjects()
        },
        methods: {
            getProjects() {
                axios.get(`/api/projects/${this.$route.params.slug}`)
                    .then(response => {
                        this.project = response.data.data
                        this.elements = response.data.data.elements
                        this.pages = response.data.data.pages
                    });
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar
        }
    }
</script>
