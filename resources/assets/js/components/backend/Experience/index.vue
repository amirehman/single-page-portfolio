<template>
    <div>
        <div class="container  m-t-15">
            <div class="column is-8">
                <p class="subtitle has-text-grey">All Experiences
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <table class="table is-fullwidth is-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="experience in experiences">
                            <td>{{experience.id}}</td>
                            <td>{{experience.title}}</td>
                            <td>{{experience.company}}</td>
                            <td><router-link :to="`/me/experience/${experience.id}`" class="button is-small">View</router-link></td>
                        </tr>
                    </tbody>
                </table>
                <p class="subtitle has-text-grey">
                    <router-link to="/me/experience/create" class="is-small is-primary button is-pulled-right">Add New</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                experiences: "",
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }
        },
        mounted() {
            this.getexperiences()
        },
        methods: {
            getexperiences () {
                axios.get('/api/experiences').then(response => {
                    this.experiences = response.data.data
                });
            }
        }
    
    }
</script>

<style>
    
</style>
