<template>
    <div>
        <div class="container  m-t-15">
            <div class="column is-8">
                <p class="subtitle has-text-grey">General Setting
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <form @submit.prevent="onUpdateAbout">
                    <table class="is-borderless table is-fullwidth is-bordered">
                        <tbody>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Intro</span>
    
                                    <quill-editor v-model="general.intro" :options="editorOption"></quill-editor>
    
                                    <p class="help is-danger" v-if="errors.intro">{{errors.intro[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Facebook</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.facebook">
                                    <p class="help is-danger" v-if="errors.facebook">{{errors.facebook[0]}}</p>
                                </td>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Twitter</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.twitter">
                                    <p class="help is-danger" v-if="errors.twitter">{{errors.twitter[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Instagram</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.instagram">
                                    <p class="help is-danger" v-if="errors.instagram">{{errors.instagram[0]}}</p>
                                </td>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Linkedin</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.linkedin">
                                    <p class="help is-danger" v-if="errors.linkedin">{{errors.linkedin[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Github</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.github">
                                    <p class="help is-danger" v-if="errors.github">{{errors.github[0]}}</p>
                                </td>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Stackoverflow</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.stackoverflow">
                                    <p class="help is-danger" v-if="errors.stackoverflow">{{errors.stackoverflow[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Company Image</span>
                                    <input required type="url" required class="input is-radiusless is-shadowless" v-model="general.companyimage">
                                    <p class="help is-danger" v-if="errors.companyimage">{{errors.companyimage[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Display Picture</span>
                                    <input name="image" type="file" class="input is-radiusless is-shadowless" @change="addImage">
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
                general: {
                    image: ""
                },
                dropfile: "",
                errors: {},
                editorOption: {

                }
    
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
            applyTextEdit() {
    
            },
            getData() {
                axios.get(`/api/general`)
                    .then(response => {
                        this.general = response.data.data
                    });
            },
            onUpdateAbout() {
                axios.put(`/api/general/${this.general.id}`, {
                        intro: this.general.intro,
                        image: this.general.image,
                        company_image: this.general.companyimage,
                        facebook: this.general.facebook,
                        twitter: this.general.twitter,
                        instagram: this.general.instagram,
                        linkedin: this.general.linkedin,
                        github: this.general.github,
                        stackoverflow: this.general.stackoverflow,
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Updated',
                            type: 'is-success'
                        });
                    })
                    .catch((error) => this.errors = error.response.data.errors)
            },
            addImage(e) {
                var fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.general.image = e.target.result;
                }
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
