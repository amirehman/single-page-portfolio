<template>
    <div>
    
            <top-navbar></top-navbar>

        <div class="about-wrapper">
            <div class="container pad-col">
                <div class="columns">
                    <div class="column is-8">
                        <div class="inner-wrapper">
    
                    <ball-pulse-sync-loader v-if="loading" color="#e67e22" size="5px"></ball-pulse-sync-loader>
    
                            <div class="about-header about-section" v-cloak>
                                <div class="content">
                                    <h3 class="button is-radiusless	">BIOGRAPHY</h3>
                                    <div v-html="profile.bio"></div>
                                </div>
                                <div class="content-img about-section image1" style="background-position: center ; background-repeat: no-repeat; background-size: cover;background-attachment: fixed;" :style="{ 'background-image': 'url(' + backgroundImgUrl + profile.image + ')' }">
                                </div>
                                <div class="about-skills about-section">
                                    <div class="content">
                                        <h3 class="button is-radiusless	">EXPERTISE</h3>
                                        <div class="about-skills-body">
    
                                            <div class="columns is-flex-mobile">
                                                <div class="column is-3" v-for="typeo in expertiesTypes">
                                                    <aside class="menu">
                                                        <p class="menu-label">
                                                            {{typeo}}
                                                        </p>
                                                        <ul class="is-paddingless is-marginless">
                                                            <template v-for="expert in experties">
                                                                <li v-if="expert.type == typeo">
                                                                    <a>{{expert.name}}</a>
                                                                </li>
                                                            </template>
                                                            
    
                                                        </ul>
                                                    </aside>
                                                </div>
    
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                                <!-- section -->
                                <div class="about-skills about-section">
                                    <div class="content">
                                        <h3 class="button is-radiusless	">WORK EXPERIENCE</h3>
    
    
                                        <div class="timeline">
                                            <header class="timeline-header">
                                                <span class="tag is-medium is-warning">Now</span>
                                            </header>
    
    
                                           
    
                                            <div class="timeline-item" v-for="experience in experiences">
                                                <div class="timeline-marker is-icon">
                                                    <i class="fa fa-suitcase"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <p class="heading">{{experience.startdate | moment("MMMM YYYY")}} - {{experience.enddate | moment("MMMM YYYY")}}</p>
                                                    <p>
                                                        <strong class="has-text-weight-semibold">{{experience.title}}</strong> -
                                                        <a href="" class="has-text-grey is-italic">{{experience.company}}</a>
                                                    </p>
                                                    <p>{{experience.detail}}</p>
                                                    <p>
                                                        <ul>
                                                            <li v-for="item in experience.items">{{item.item}}</li>
                                                        </ul>
                                                    </p>
                                                </div>
                                            </div>
    
    
                                            <!--<header class="timeline-header">
                                                <span class="tag is-warning">2013</span>
                                            </header>-->

    
                                            <div class="timeline-header">
                                                <span class="tag is-medium is-warning">Start</span>
                                            </div>
                                        </div>
    
    
    
                                    </div>
                                </div>
                                <!-- section -->
    
                                <div class="about-section">
                                    <div class="content">
                                        <h3 class="button is-radiusless">EDUCATION</h3>
    
                                        <div class="timeline">
    
                                            <div class="timeline-item" v-for="edu in educations">
                                                <div class="timeline-marker"></div>
                                                <div class="timeline-content">
                                                    <p class="heading">{{edu.date | moment("MMMM YYYY")}}</p>
                                                    <p><strong class="has-text-weight-semibold">{{edu.name}}</strong> - {{edu.institue}}</p>
                                                </div>
                                            </div>
    

                                        </div>
    
    
                                    </div>
                                </div>
    
                                <div class="about-section">
                                    <div class="content has-text-centered">
                                        <a :href="`${backgroundImgUrl}resume/${profile.resume}`" download class="button is-warning section-header is-medium">Download Resume</a>
                                    </div>
                                </div>
    
    
    
    
    
                            </div>
    
                        </div>
                    </div>
    
                    <div class="column">
                        <div class="about-header">
    
    
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
        <footer-bottom v-if="!loading"></footer-bottom>
    
    </div>
</template>

<script>
    import uniq from 'lodash/uniq';
    import footer from "./Footer";
    import navbar from "./TopNav";

    export default {
        data() {
            return {
                profile: {
                    image: ""
                },
                experties: {},
                expertiesTypes: {},
                backgroundImgUrl: "http://45.77.65.13/images/",
                experiences: {},
                educations: {},
                loading: true
            }
        },
        created() {
            this.about()
            this.getExperties()
            this.getexperiences()
            this.getEducations()
        },
        methods: {
            about() {
                axios.get(`/api/about`)
                    .then(response => {
                        this.profile = response.data.data
                        this.loading = false
                    });
            },
            getExperties() {
                axios.get(`/api/experties`)
                    .then(response => {
                        this.experties = response.data.data
                        this.expertiesTypes = uniq(response.data.data.map(e => e.type))
                    });
            },
            getexperiences () {
                axios.get('/api/experiences').then(response => {
                    this.experiences = response.data.data
                });
            },
            getEducations() {
                axios.get(`/api/educations`)
                    .then(response => {
                        this.educations = response.data.data
                    });
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar
        }
    
    }
</script>



<style scropped>
    .arZxkKg-w3Qec3gGdgaPh_0 {
        background-position: center center; 
        background-repeat: no-repeat; 
        background-size: cover; 
        background-attachment: fixed;
    }
</style>