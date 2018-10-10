<template>
    <div>
    
        <div class="container">
    
            <div class="container  m-t-0">
                <div class="columns">
    
                    <div class="column is-6">
    
                        <p class="subtitle has-text-grey">Update {{page.title}}
                        
                        <a @click="$router.go(-1)" class="is-small button is-pulled-right  m-r-15">Go Back ↵</a>
                        <router-link to="/me/dashboard" class="is-small button is-pulled-right m-r-5">Dashboard</router-link>
                        
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
                                            <input name="image" type="file" class="input is-radiusless is-shadowless" @change="addImage">
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
                                            <span class="button has-text-danger has-text-weight-semibold is-small is-radiusless is-shadowless is-pulled-right" @click="confirmdelete">Delete Permenetly</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
    
                    <div class="column is-3">
                        <img :src="`${baseURL}images/${page.image}`">
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        data() {
            return {
                page: {},
                dropfile: "",
                errors: {},
                baseURL: "http://127.0.0.1:8000/"
    
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            } else {
                this.getPage();
            }
        },
        methods: {
            getPage() {
                axios.get(`/api/projects/${this.$route.params.projectid}/pages/${this.$route.params.pageid}`)
                    .then(response => {
                        this.page = response.data
                    });
            },
            onSubmitPage() {
                axios.put(`/api/projects/${this.$route.params.projectid}/pages/${this.$route.params.pageid}`, {
                        title: this.page.title,
                        date: this.page.date,
                        detail: this.page.detail,
                        image: this.page.image,
                        pid: this.$route.params.projectid
                    })
                    .then(response => {
                        this.getPage()
                        this.$toast.open({
                            duration: 800,
                            message: 'Page Updated Successfully',
                            type: 'is-success'
                        });
                    })
                    .catch((error) => this.errors = error.response.data.errors)
            },
            addImage(e) {
                var fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.page.image = e.target.result;
                }
            },
            confirmdelete() {
                this.$dialog.confirm({
                    title: 'Are you sure?',
                    message: 'The page will be deleted permenently. kabi recover nahi kar pao ge.',
                    type: 'is-danger',
                    onConfirm: () => this.deletePage()
                });
            },
            deletePage() {
                axios.delete(`/api/projects/${this.$route.params.projectid}/pages/${this.$route.params.pageid}`).then((response) => {
                    this.$toast.open({
                        duration: 2000,
                        message: `Page Deleted Successfully`,
                        type: 'is-success'
                    });
                    this.$router.push({
                        name: 'singleproject',
                        params: {
                            slug: response.data
                        }
                    })
                });
            }
        },
        components: {
            Datepicker
        }
    
    }
</script>

<style>
    
</style>
