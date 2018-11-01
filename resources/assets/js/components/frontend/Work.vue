<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="container pad-col">
            <div class="work-header">
                <div class="content text-center">
                    <div class="columns">
                        <div class="column is-12">
                            <div class="content"> 
                            <p class="has-text-weight-normal is-size-6">See my works below. all their back-end and front-end parts were completely done by me. Much of my most recent work using current technologies has been for internal enterprise web apps which naturally can't be shared with the public.</p>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
    
    
            <div class="columns m-t-75">
                <div class="column">
                    <div class="work-wrapper">
                        <ball-pulse-sync-loader v-if="loading" color="#e67e22" size="5px"></ball-pulse-sync-loader>
    
                        <div class="work-row" v-cloak>
    
                            <masonry :cols="{default: 3, 1399: 2, 550: 1}" :gutter="15">
                            <div class="work-col" v-for="(project, index) in projects" :key="index">
                                <router-link :to="`/work/${project.slug}`">
                                    <div class="card">
                                    
                                        <div class="card-image">
                                        <div class="card-content">
                                            <div class="content">
                                                <p>{{project.title}}
                                                </p>
                                                <p class="elements">
                                                    <span v-for="element in project.elements">{{element.name}}</span>
                                                </p>
                                            </div>
                                        </div>
                                            <figure class="image">
                                                <clazy-load :src="`${baseURL}images/${project.image}`">
                                                    <img :src="`${baseURL}images/${project.image}`">
                                                    <div class="preloader" slot="placeholder">
                                                        <div class="timeline-item">
                                                            <div class="animated-background">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </clazy-load>
                                            </figure>
                                        </div>
                                        
                                    </div>
                                </router-link>
                            </div>
                            <!-- work-col -->
                            </masonry>    
    
    
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
                projects: {},
                baseURL: "https://www.amirr.net/",
                loading: true
    
            }
        },
        mounted() {
            this.getProjects()
        },
        methods: {
            getProjects() {
                axios.get('/api/projects').then(response => {
                    this.projects = response.data.data
                    this.loading = false
                });
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar,
            "clazy-load": VueClazyLoad
        }
    }
</script>

