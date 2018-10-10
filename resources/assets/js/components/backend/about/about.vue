<template>
    <div>
        <div class="container  m-t-0">
            <div class="columns">
                <div class="column is-8">
                    <p class="subtitle has-text-grey">About
                        <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                    </p>
                    <form @submit.prevent="onUpdateAbout">
                        <table class="is-borderless table is-fullwidth is-bordered">
                            <tbody>
                                <tr>
                                    <td class="p-l-0">
                                        <span class="m-b-5 is-block has-text-weight-semibold">Name</span>
                                        <input type="text" required class="input is-radiusless is-shadowless" v-model="profile.name">
                                        <p class="help is-danger" v-if="errors.name">{{errors.name[0]}}</p>
                                    </td>
                                    <td class="p-l-0">
                                        <span class="m-b-5 is-block has-text-weight-semibold">Email</span>
                                        <input type="email" class="input is-radiusless is-shadowless" v-model="profile.email">
                                        <p class="help is-danger" v-if="errors.email">{{errors.email[0]}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-l-0" colspan="2">
                                        <span class="m-b-5 is-block has-text-weight-semibold">Photo</span>
                                        <input name="image" type="file" class="input is-radiusless is-shadowless" @change="addImage">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-l-0" colspan="2">
                                        <span class="m-b-5 is-block has-text-weight-semibold">Bio</span>
                                        <quill-editor v-model="profile.bio"></quill-editor>
                                        <p class="help is-danger" v-if="errors.bio">{{errors.bio[0]}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-l-0">
                                        <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Update</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
    
                <div class="column is-3">
                    <table class="is-borderless table is-fullwidth m-t-60">
                        <tr>
                            <td class="p-l-0">
                                <span class="m-b-5 is-block has-text-weight-semibold">Change Resume</span>
                                <input name="resume" type="file" class="input is-radiusless is-shadowless" @change="addResume">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        quillEditor
    } from 'vue-quill-editor'
    import Datepicker from 'vuejs-datepicker';
    
    export default {
        data() {
            return {
                profile: {
                    image: ""
                },
                dropFiles: {},
                errors: {}
    
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            } else {
                this.getData();
            }
        },
        methods: {
            getData() {
                axios.get(`/api/about`)
                    .then(response => {
                        this.profile = response.data.data
                    });
            },
            onUpdateAbout() {
                axios.put(`/api/about/${this.profile.id}`, {
                        name: this.profile.name,
                        email: this.profile.email,
                        image: this.profile.image,
                        bio: this.profile.bio
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Bio Updated',
                            type: 'is-success'
                        });
                    })
                    .catch((error) => this.errors = error.response.data.errors)
            },
            addImage(e) {
                var fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.profile.image = e.target.result;
                }
            },
            addResume() {
    
                this.dropFiles = event.target.files[0];
                const formData = new FormData();
                formData.append('resume', this.dropFiles, this.dropFiles.name);
    
                axios.post(`/api/xigmig/addresume/${this.profile.id}`, {
                    data: formData,
                    _method: 'patch'
                }).then(response => {
                    this.getImages();
                    this.$toast.open({
                        duration: 5000,
                        message: `Image Uploaded`,
                        position: 'is-bottom',
                        type: 'is-success'
                    });
                })
    
    
            }
        },
        components: {
            Datepicker,
            quillEditor
        }
    
    }
</script>


<style scopped>
    @import '~quill/dist/quill.core.css';
    @import '~quill/dist/quill.snow.css';
    @import '~quill/dist/quill.bubble.css';
    .ql-editor {
        min-height: 190px;
        font-size: 22px;
    }
</style>
