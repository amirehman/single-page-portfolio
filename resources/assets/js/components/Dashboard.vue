<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-12">
                <p class="subtitle has-text-grey">Dashboard</p>
    
                <div class="columns is-multiline">


                    <div class="column is-3">
                        <router-link to="/me/projects" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        Projects
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->

                    <div class="column is-3">
                        <router-link to="/me/elements" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        Elements
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->


                    <div class="column is-3">
                        <router-link to="/me/experties" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        Experties
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->


                    <div class="column is-3">
                        <router-link to="/me/experiences" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        Experiences
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->

                    <div class="column is-4">
                        <router-link to="/me/education" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        Education
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->

                    <div class="column is-4">
                        <router-link to="/me/about" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        About
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->

                    <div class="column is-4">
                        <router-link to="/me/general" class="title is-4 has-text-weight-normal">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content has-text-centered">
                                        General
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div><!--column-->


                </div>


                <div class="navbar-menu m-t-75 dashboard-navbar">
                        <div class="navbar-start">
                            <router-link class="navbar-item is-radiusless" to="/"> Visit Site </router-link>
                        </div>

                    </div>
    
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
    
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }
        }
    
    
    }
</script>

<style scopped>
</style>
