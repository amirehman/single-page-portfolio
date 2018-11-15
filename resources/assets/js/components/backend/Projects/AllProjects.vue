<template>
    <div>
        <div class="container  m-t-15">
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
                    <draggable class="tbody" v-model="projects" :options="{group:'projects'}" @start="drag=true" @end="drag=false" @change="onChnage">
                        <tr v-for="(project, index) in projects">
                            <td>{{index + 1}}</td>
                            <td>{{project.title}}</td>
                            <td>{{project.date | moment("Do, MMMM YYYY") }}</td>
                            <td><router-link :to="`/me/project/${project.slug}`" class="button is-small">View</router-link></td>
                        </tr>
                    </draggable>
                </table>
                <p class="subtitle has-text-grey">
                    <router-link to="/me/projects/new" class="is-small is-primary button is-pulled-right">Add New</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        data() {
            return {
                projects: []
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
            },
            onChnage(evt) {
                let newProject = this.projects.map((project, index) => {
                    project.priority = index + 1;
                    return project;
                })
                axios.patch('/api/projects/update-all', {
                        project: newProject
                    })
                    .then(response => {
                        // console.log(response);
                    })
            }
        },
        components: {
            draggable,
        },
    
    }
</script>

<style>
    
</style>
