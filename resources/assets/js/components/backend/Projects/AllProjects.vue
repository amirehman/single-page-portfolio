<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8">
                <p class="subtitle has-text-grey">All Projects
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <table class="table is-fullwidth is-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="project in projects">
                            <td>{{project.id}}</td>
                            <td>{{project.title}}</td>
                            <td>{{project.date}}</td>
                            <td><router-link :to="`/me/project/${project.slug}`" class="button is-small">View</router-link></td>
                        </tr>
                    </tbody>
                </table>
                <p class="subtitle has-text-grey">
                    <router-link to="/me/projects/new" class="is-small is-primary button is-pulled-right">Add New</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                projects: "",
            }
        },
        created () {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }
        },
        mounted() {
            this.getProjects()
        },
        methods: {
            getProjects () {
                axios.get('/api/projects').then(response => {
                    this.projects = response.data.data
                });
            }
        }
    
    }
</script>

<style>
    
</style>
