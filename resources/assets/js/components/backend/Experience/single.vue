<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8">
                <p class="subtitle has-text-grey">Edit Experience
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <form @submit.prevent="onSubmitExperience">
                    <table class="is-borderless table is-fullwidth is-paddingless">
                        <tbody>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Title</span>
                                    <input name="title" type="text" class="input is-radiusless is-shadowless" required v-model="experience.title">
                                    <p class="help is-danger" v-if="errors.title">{{errors.title[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td  class="p-l-0" >
                                    <span class="m-b-5 is-block has-text-weight-semibold">Company</span>
                                     <input name="title" type="text" class="input is-radiusless is-shadowless" required v-model="experience.company">
                                    <p class="help is-danger" v-if="errors.company">{{errors.company[0]}}</p>
                                </td>
                                <td  class="p-l-0" >
                                    <span class="m-b-5 is-block has-text-weight-semibold">Company Website</span>
                                     <input name="title" type="url" class="input is-radiusless is-shadowless" required v-model="experience.companylink">
                                    <p class="help is-danger" v-if="errors.company_link">{{errors.company_link[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td  class="p-l-0" >
                                    <span class="m-b-5 is-block has-text-weight-semibold">Start Date</span>
                                    <datepicker name="date" input-class="input is-radiusless is-shadowless" required v-model="experience.startdate"></datepicker>
                                    <p class="help is-danger" v-if="errors.start_date">{{errors.start_date[0]}}</p>
                                </td>
                                <td  class="p-l-0" >
                                    <span class="m-b-5 is-block has-text-weight-semibold">End Date</span>
                                    <datepicker name="date" input-class="input is-radiusless is-shadowless" required v-model="experience.enddate"></datepicker>
                                    <p class="help is-danger" v-if="errors.end_date">{{errors.end_date[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0"  colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea name="detail" class="textarea is-radiusless is-shadowless" required v-model="experience.detail"></textarea>
                                    <p class="help is-danger" v-if="errors.detail">{{errors.detail[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0"  colspan="2">
                                    <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Submit</button>
                                    <span class="button has-text-danger has-text-weight-semibold is-radiusless is-shadowless is-pulled-right" @click="confirmdelete">Delete Permenetly</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <experience-list></experience-list>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import ExperienceList from './items';
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
                errors: {}
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }else{
                this.getExperience();
            }
        },
        methods: {
            getExperience() {
                axios.get(`/api/experiences/${this.$route.params.id}`)
                    .then(response => {
                        this.experience = response.data.data
                    });
            },
            onSubmitExperience() {
                axios.put(`/api/experiences/${this.experience.id}`, {
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
                            message: 'Experience Updated Successfully',
                            type: 'is-success'
                        });
                    })
                    .catch((error) => this.errors = error.response.data.errors)
            },
            confirmdelete() {
                this.$dialog.confirm({
                    title: 'Are you sure?',
                    message: 'The experience will be deleted permenently. kabi recover nahi kar pao ge.',
                    type: 'is-danger',
                    onConfirm: () => this.deleteProject()
                });
            },
            deleteProject(id) {
                axios.delete(`/api/experiences/${this.experience.id}`).then((response) => {
                    this.$toast.open({
                        duration: 2000,
                        message: `Experience Deleted Successfully`,
                        type: 'is-success'
                    });
                });
                this.$router.push({
                    name: 'allexperiences'
                })
            }
        },
        components: {
            Datepicker,
            ExperienceList
        }
    
    }
</script>
