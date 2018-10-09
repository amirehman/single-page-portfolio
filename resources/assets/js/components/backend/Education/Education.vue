<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8" v-if="!editing">
                <p class="subtitle has-text-grey">Add Education
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <form @submit.prevent="onSubmitElement">
                    <table class="is-borderless table is-fullwidth is-bordered">
                        <tbody>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Name</span>
                                    <input type="text" required class="input is-radiusless is-shadowless" v-model="element.name">
                                    <p class="help is-danger" v-if="errors.title">{{errors.title[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Institute</span>
                                    <input type="text" required class="input is-radiusless is-shadowless" v-model="element.institue">
                                    <p class="help is-danger" v-if="errors.institue">{{errors.institue[0]}}</p>
                                </td>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Institue Link</span>
                                    <input type="url" class="input is-radiusless is-shadowless" v-model="element.link">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Date</span>
                                    <datepicker name="date" input-class="input is-radiusless is-shadowless" required v-model="element.date"></datepicker>
                                    <p class="help is-danger" v-if="errors.date">{{errors.date[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea v-model="element.detail"class="textarea is-radiusless is-shadowless"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    
            <div class="column is-8" v-if="editing">
                <p class="subtitle has-text-grey">Edit {{element.name}} Education</p>
                <form @submit.prevent="onUpdateElement">
                    <table class="is-borderless table is-fullwidth is-bordered">
                        <tbody>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Name</span>
                                    <input type="text" required class="input is-radiusless is-shadowless" v-model="element.name">
                                    <p class="help is-danger" v-if="errors.title">{{errors.title[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Institute</span>
                                    <input type="text" required class="input is-radiusless is-shadowless" v-model="element.institue">
                                    <p class="help is-danger" v-if="errors.institue">{{errors.institue[0]}}</p>
                                </td>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Institue Link</span>
                                    <input type="url" class="input is-radiusless is-shadowless" v-model="element.link">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Date</span>
                                    <datepicker name="date" required input-class="input is-radiusless is-shadowless" required v-model="element.date"></datepicker>
                                    <p class="help is-danger" v-if="errors.date">{{errors.date[0]}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0" colspan="2">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Detail</span>
                                    <textarea v-model="element.detail"class="textarea is-radiusless is-shadowless"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Submit</button>
                                    <span class="button has-text-weight-semibold is-radiusless is-shadowless" @click="cancelEdit">Cancel</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    
    
            <div class="column is-8 m-t-50">
    
                <table class="table table is-fullwidth is-bordered">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Institue</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(element, key) in elements">
                            <td>
                                {{element.name}}
                            </td>
                            <td>
                                <a :href="`http://${element.link}`" target="_blank">{{element.institue}}</a>
                            </td>
                            <td>
                                <button class="button is-success is-small is-radiusless is-shadowless" 
                                    @click="editElement(key,element.id, element.name, element.institue, element.link, element.date, element.detail)"
                                    >Edit</button>
                            </td>
                            <td>
                                <button class="button is-danger is-small is-radiusless is-shadowless" @click="confirmdelete(key,element.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="columns">
                    <div class="column">
                        
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
                element: {
                    name: "",
                    link: "http://"
                },
                date: new Date(),
                elements: [],
                editing: false,
                elementId: "",
                errors: ""
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }else{
                this.getElements();
            }
        },
        methods: {
            getElements() {
                axios.get(`/api/educations`)
                    .then(response => {
                        this.elements = response.data.data
                    });
            },
            onSubmitElement() {
                axios.post(`/api/educations`, {
                        title: this.element.name,
                        institue: this.element.institue,
                        detail: this.element.detail,
                        datee: this.element.date,
                        link: this.element.link
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Education Added Successfully',
                            type: 'is-success'
                        });
                    })
                    .catch((error) => this.errors = error.response.data.errors)
                this.getElements()
                this.element = {}
            },
            cancelEdit() {
                this.editing = false
                this.element = {}
            },
            editElement(key, id, name, institue, link, date, detail) {
                this.editing = true
                this.elementId = id
                this.element.name = name
                this.element.institue = institue
                this.element.link = link
                this.element.date = date
                this.element.detail = detail
            },
            onUpdateElement() {
                axios.put(`/api/educations/${this.elementId}`, {
                        title: this.element.name,
                        institue: this.element.institue,
                        detail: this.element.detail,
                        datee: this.element.date,
                        link: this.element.link
                    })
                    .then(response => {
                        this.getElements()
                        this.element.name = ""
                        this.element.institue = ""
                        this.element.link = ""
                        this.element.date = ""
                        this.element.detail = ""
                        this.$toast.open({
                            duration: 800,
                            message: 'Education Updated Successfully',
                            type: 'is-success'
                        });
                    })
                    .catch((error) => this.errors = error.response.data.errors)
            },
            confirmdelete(key, id) {
                this.$dialog.confirm({
                    title: 'Are you sure?',
                    message: 'per kabi revover nahi hoga.',
                    type: 'is-danger',
                    onConfirm: () => this.deleteElement(key, id)
                });
            },
            deleteElement(key, id) {
                axios.delete(`/api/educations/${id}`)
                    .then((response) => {
                        this.elements.splice(key, 1);
                        this.$toast.open({
                            duration: 2000,
                            message: `Education Delete Successfully`,
                            type: 'is-success'
                        });
                    })
            }
        },
        components: {
            Datepicker
        }
    
    }
</script>

<style>
    
</style>
