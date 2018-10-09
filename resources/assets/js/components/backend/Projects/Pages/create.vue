<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8">
    
                <p class="subtitle has-text-grey">Add Page
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
    
                <form @submit.prevent="onSubmitPage">
                    <table class="is-borderless table is-fullwidth create-table is-paddingless-left-right">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">Title</span>
                                    <input name="title" type="text" class="input is-radiusless is-shadowless" v-model="page.title" required>
                                    <p class="help is-danger" v-if="errors.title">{{errors.title[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">Image</span>
                                    <input name="image" type="file" class="input is-radiusless is-shadowless" @change="addImage" required>
                                    <p class="help is-danger" v-if="errors.image">{{errors.image[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea name="detail" class="textarea is-radiusless is-shadowless" v-model="page.detail"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
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
                page: {
                    title: "",
                    date: "",
                    detail: "",
                    image: ""
                },
                dropfile: "",
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
            onSubmitPage() {
                axios.post(`/api/projects/${this.$route.params.id}/pages`, {
                        title: this.page.title,
                        date: this.page.date,
                        detail: this.page.detail,
                        image: this.page.image

                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Page Created Successfully',
                            type: 'is-success'
                        });
                        this.$router.push({
                            name: 'singleproject',
                            params: {
                                slug: response.data
                            }
                        })
                    })
                    .catch((error) => this.errors = error.response.data.errors)
            },
            addImage(e) {
                var fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.page.image = e.target.result;
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
