<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="container">
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
    
                        <div class="work-row">
    
                            <!--<div class="work-col col-lg">
                                    <div class="card">
                                        <div class="card-image">
        
                                            <ul class="assets">
                                                <li>HTML</li>
                                                <li>Laravel</li>
                                                <li>jQuery</li>
                                                <li>Vuejs</li>
                                                <li>AngularJs</li>
                                            </ul>
        
                                            <figure class="image   is-1by3">
                                                <img src="images/work/4.png" alt="Placeholder image">
                                            </figure>
                                        </div>
                                        <div class="card-content">
                                            <div class="content">
                                                <a href="">
                                                    <p>National Paints
                                                        <time datetime="2016-1-1">1 Jan 2016</time>
                                                    </p>
                                                </a>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            <!-- work-col -->
    
                            <div class="work-col col-sm" v-for="project in projects">
                                <router-link :to="`/work/${project.slug}`">
                                    <div class="card">
                                        <div class="card-image">
                                            <figure class="image is-4by3">
                                                <img :src="`${baseURL}images/${project.image}`" class="is-block">
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
    
        <footer-bottom></footer-bottom>
    
    </div>
</template>

<script>
    import footer from "./Footer";
    import navbar from "./TopNav";
    export default {
        data() {
            return {
                projects: {},
                baseURL: "http://127.0.0.1:8000/"
    
            }
        },
        mounted() {
            this.getProjects()
        },
        methods: {
            getProjects() {
                axios.get('/api/projects').then(response => {
                    this.projects = response.data.data
                });
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar
        }
    }
</script>
