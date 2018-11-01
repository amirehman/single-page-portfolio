<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="single-wrapper">
    
            <div class="container pad-col">
                <div class="columns">
                    <div class="column is-8">
                        <ball-pulse-sync-loader v-if="loading" color="#e67e22" size="5px"></ball-pulse-sync-loader>
                        <div class="inner-wrapper" v-cloak>
                            <header class="single-header has-text-left">
                                <span class="is-marginless is-size-7 has-text-grey" v-if="!loading">Project</span>
                                <h3 class="is-marginless is-size-3">{{project.title}}</h3>
                                <p>{{project.detail}}</p>
    
                                <div class="single-elemets aaa" v-if="!loading">
                                    <h4 class="is-size-5">Elemets used in this project</h4>
                                    <ul>
                                        <li class="button m-r-5 is-radiusless" v-for="element in elements">
                                            <a target="_blank" :href="`${element.link}`">{{element.name}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="single-link" v-if="!loading">
                                    <h4 v-if="project.link" class="is-size-5">Project Live Link</h4>
                                    <p v-if="project.link"><a :href="project.link" target="_blank">{{project.link}}</a> <i class="fa fa-external-link"> </i></p>
                                </div>
                            </header>
                            <hr v-if="!loading">
    
                            <div class="single-body">
                                <ul>
    
                                    <li v-for="page in pages">
                                        <span class="vline"></span>
                                        <h4 class="is-size-4 is-marginless">{{page.title}}</h4>
                                        <p class="is-size-6">{{page.detail}}</p>
                                        <template v-if="page.image">
                                            <clazy-load :src="`${baseURL}images/${page.image}`">
                                                        <img :src="`${baseURL}images/${page.image}`">
                                                        <div class="preloader" slot="placeholder">
                                                            <div class="timeline-item">
                                                                <div class="animated-background">
                                                                </div>
                                                            </div>
                                                        </div>
                                            </clazy-load>
                                            </template>
                                </li>

                            </ul>
                        </div>
                    </div>


                    <div class="single-like has-text-centered"  v-cloak>
                        <i @click="likeProject"  v-if="!loading" class="fa fa-heart" title="git it a thumbs up"></i>
                        <span class="like-counter">{{project.likes}}</span> 
                    </div>


                </div>
            </div>
        </div>
    </div>
    
        <footer-bottom v-if="!loading"></footer-bottom>
    
    </div>
</template>

<script>
    import footer from "./Footer";
    import navbar from "./TopNav";
    import {
        VueClazyLoad
    } from 'vue-clazy-load';
    
    export default {
        data() {
            return {
                project: {},
                baseURL: "https://www.amirr.net/",
                elements: {},
                pages: {},
                loading: true,
                messages: ['Sweet', 'WoW', 'Thank You', 'Ok, Thats Cool'],
                selectedMessage: ""
    
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
                        this.loading = false
    
                    });
            },
            likeProject() {
                const idx = Math.floor(Math.random() * this.messages.length);
                this.selectedMessage = this.messages[idx]
                axios.put(`/api/projects/${this.project.id}`, {
                        title: this.project.title,
                        date: this.project.date,
                        detail: this.project.detail,
                        like: 1
                    })
                    .then(response => {
                        this.project.likes += 1;
                        this.$toast.open({
                            duration: 2000,
                            message: this.selectedMessage,
                            type: 'is-success'
                        });
                    })
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar,
            "clazy-load": VueClazyLoad
        }
    }
</script>
