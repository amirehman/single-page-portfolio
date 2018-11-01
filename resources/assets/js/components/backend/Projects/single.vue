<template>
    <div>
        <div class="container  m-t-30">
            <div class="columns">

                <div class="column is-8">
                <p class="subtitle has-text-grey">Edit Project
                    <a @click="$router.go(-1)" class="is-small button is-pulled-right  m-r-15">Go Back ↵</a>
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right m-r-5">Dashboard</router-link>
                </p>
                <form @submit.prevent="onSubmitProject">
                    <table class="is-borderless table is-fullwidth is-bordered">
                        <tbody>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Title</span>
                                    <input type="text" class="input is-radiusless is-shadowless" v-model="project.title">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Date</span>
                                    <datepicker input-class="input is-radiusless is-shadowless" v-model="project.date"></datepicker>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Thumbnail</span>
                                    <input name="image" type="file" class="input is-radiusless is-shadowless" @change="addImage">
                                    <p class="help is-danger" v-if="errors.thumbnail">{{errors.thumbnail[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Target Link</span>
                                    <input type="url" class="input is-radiusless is-shadowless" v-model="project.link">
                                    <p class="help is-danger" v-if="errors.link">{{errors.thumbnail[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea class="textarea is-radiusless is-shadowless" v-model="project.detail"></textarea>
                                </td>
                            </tr>
    
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Elements</span>
                                    <label class="checkbox is-large m-r-15  is-capitalized" v-for="element in elements">
                                            <input type="checkbox" :value="element.id" v-model="selectedElements"> <span class="checkbox-label"> {{element.name}} </span>
                                        </label>
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <button type="submit" class="button m-t-25 is-primary has-text-weight-semibold is-radiusless is-shadowless">Save</button>
                                    <a href="#" class="button has-text-danger m-t-25 is-pulled-right is-radiusless is-shadowless" @click.prevent="confirmdelete(project.id)">Delete Permanently </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
    
    
                    <all-pages :project-id="project.id" :project-slug="project.slug"></all-pages>
    
                </form>
            </div>
            <div class="column is-3">
                <img :src="`${baseURL}images/${project.image}`" class="is-block m-t-100">
            </div>

            </div>
            <!-- Adding Tags -->
    
    
    
    
    
    
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import AllPages from './Pages/index.vue'
    export default {
        data() {
            return {
                project: {},
                date: new Date(),
                elements: [],
                selectedElements: [11, 12],
                errors: {},
                baseURL: "https://45.77.65.13/"
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            } else {
                this.getProject();
                this.getElements();
            }
        },
        methods: {
            getElements() {
                axios.get(`/api/elements`)
                    .then(response => {
                        this.elements = response.data.elements
                    });
            },
            getProject() {
                axios.get(`/api/projects/${this.$route.params.slug}`)
                    .then(response => {
                        this.project = response.data.data
                        this.selectedElements = response.data.data.elements.map(e => e.id)
                    });
            },
            formatter(d) {
                return d.toLocaleDateString()
            },
            onSubmitProject() {
                axios.put(`/api/projects/${this.project.id}`, {
                        title: this.project.title,
                        date: this.project.date,
                        image: this.project.image,
                        link: this.project.link,
                        detail: this.project.detail,
                        elements: this.selectedElements
                    })
                    .then(response => {
                        this.getElements()
                        this.getProject()
                        this.$toast.open({
                            duration: 800,
                            message: 'Project Updated Successfully',
                            type: 'is-success'
                        });
                    })
                    
            },
            confirmdelete(id) {
                this.$dialog.confirm({
                    title: 'Are you sure?',
                    message: 'The project will be deleted permenently. kabi recover nahi kar pao ge.',
                    type: 'is-danger',
                    onConfirm: () => this.deleteProject(id)
                });
            },
            deleteProject(id) {
                axios.delete(`/api/projects/${id}`).then((response) => {
                    this.$toast.open({
                        duration: 2000,
                        message: `Project Deleted Successfully`,
                        type: 'is-success'
                    });
                });
                this.$router.push({
                    name: 'allprojects'
                })
            },
            addImage(e) {
                var fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.project.image = e.target.result;
                }
            }
        },
        components: {
            Datepicker,
            AllPages
        }
    
    }
</script>

<style>
    
</style>
