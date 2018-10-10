<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8">
                <p class="subtitle has-text-grey">Add New Experience
                        <a @click="$router.go(-1)" class="is-small button is-pulled-right  m-r-15">Go Back ↵</a>
                        <router-link to="/me/dashboard" class="is-small button is-pulled-right m-r-5">Dashboard</router-link>
                </p>
                <form @submit.prevent="onSubmitProject">
                    <table class="is-borderless table is-fullwidth is-paddingless">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Title</span>
                                    <input name="title" type="text" class="input is-radiusless is-shadowless" required v-model="experience.title">
                                    <p class="help is-danger" v-if="errors.title">{{errors.title[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">Company</span>
                                     <input name="title" type="text" class="input is-radiusless is-shadowless" required v-model="experience.company">
                                    <p class="help is-danger" v-if="errors.company">{{errors.company[0]}}</p>
                                </td>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">Company Website</span>
                                     <input name="title" type="url" class="input is-radiusless is-shadowless" required v-model="experience.companylink">
                                    <p class="help is-danger" v-if="errors.company_link">{{errors.company_link[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">Start Date</span>
                                    <datepicker name="date" input-class="input is-radiusless is-shadowless" required v-model="experience.startdate"></datepicker>
                                    <p class="help is-danger" v-if="errors.start_date">{{errors.start_date[0]}}</p>
                                </td>
                                <td>
                                    <span class="m-b-5 is-block has-text-weight-semibold">End Date</span>
                                    <datepicker name="date" input-class="input is-radiusless is-shadowless" required v-model="experience.enddate"></datepicker>
                                    <p class="help is-danger" v-if="errors.end_date">{{errors.end_date[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea name="detail" class="textarea is-radiusless is-shadowless" required v-model="experience.detail"></textarea>
                                    <p class="help is-danger" v-if="errors.detail">{{errors.detail[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Submit</button>
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
                experience: {
                    title: "",
                    company: "",
                    companylink: "http://",
                    startdate: "",
                    enddate: "",
                    detail: ""
                },
                errors: ""
    
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }
        },
        methods: {
            onSubmitProject() {
                axios.post(`/api/experiences`, {
                        title: this.experience.title,
                        company: this.experience.company,
                        company_link: this.experience.companylink,
                        start_date: this.experience.startdate,
                        end_date: this.experience.enddate,
                        detail: this.experience.detail
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: response.data,
                            type: 'is-success'
                        });
                        this.$router.push({ name: 'singleexperience', params: { slug: response.data }})
                    })
                    .catch((error) => this.errors = error.response.data.errors)
    
    
            }
        },
        components: {
            Datepicker
        }
    
    }
</script>

<style>
    
</style>
