<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8">
                <p class="subtitle has-text-grey">Add Project
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <form @submit.prevent="onSubmitProject">
                    <table class="is-borderless table is-fullwidth is-paddingless">
                        <tbody>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Title</span>
                                    <input name="title" type="text" class="input is-radiusless is-shadowless" v-model="project.title">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Date</span>
                                    <datepicker name="date" input-class="input is-radiusless is-shadowless" v-model="project.date"></datepicker>
    
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Thumbnail</span>
                                    <input name="image" type="file" class="input is-radiusless is-shadowless" @change="addImage" required>
                                    <p class="help is-danger" v-if="errors.thumbnail">{{errors.thumbnail[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea name="detail" class="textarea is-radiusless is-shadowless" v-model="project.detail"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Save</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        data() {
            return {
                project: {
                    title: "",
                    date: "",
                    detail: "",
                    image: ""
                },
                errors: {}
    
            }
        },
        created () {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }
        },
        methods: {
            onSubmitProject() {
                axios.post(`/api/projects`, {
                        title: this.project.title,
                        date: this.project.date,
                        image: this.project.image,
                        detail: this.project.detail
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Project Created Successfully',
                            type: 'is-success'
                        });
                        this.$router.push({ name: 'singleproject', params: { slug: response.data.slug }})
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
            Datepicker
        }
    
    }
</script>

<style>
    
</style>
