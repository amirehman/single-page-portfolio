<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="container pad-col">
            <div class="work-header">
                <div class="content text-center">
                    <div class="columns">
                        <div class="column is-8">
                            <p class="has-text-weight-normal is-size-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab eum veniam obcaecati sit dolorum iusto libero corrupti minus molestias, voluptate officia dolorem nam reiciendis dolore consequuntur dolor. Saepe, nihil natus?</p>
                        </div>
    
                    </div>
                </div>
            </div>
    
    
            <div class="columns">
                <div class="column">
                    <div class="work-wrapper">
                        <ball-pulse-sync-loader v-if="loading" color="#e67e22" size="5px"></ball-pulse-sync-loader>
    
                        <div class="work-row" v-cloak>
    
                            <div class="work-col col-sm" v-for="project in projects">
                                <router-link :to="`/work/${project.slug}`">
                                    <div class="card">
                                        <div class="card-image">
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
                                        <div class="card-content">
                                            <div class="content">
    
                                                <p>{{project.title}}
                                                    <!-- <time datetime="2016-1-1">{{project.date}}</time> -->
                                                </p>
                                                <p class="elements">
                                                    <span v-for="element in project.elements">{{element.name}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                            <!-- work-col -->
    
    
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
                baseURL: "http://45.77.65.13/",
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

