<template>
    <div>
        <div class="container  m-t-0">
            <div class="column is-8" v-if="!editing">
                <p class="subtitle has-text-grey">Add New Expertie    
                    <router-link to="/me/dashboard" class="is-small button is-pulled-right">Dashboard</router-link>
                </p>
                <form @submit.prevent="onSubmitElement">
                    <table class="is-borderless table is-fullwidth is-bordered">
                        <tbody>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Name</span>
                                    <input type="text" required class="input is-radiusless is-shadowless" v-model="element.name">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Type</span>
                                    <div class="select is-fullwidth is-radiusless is-shadowles" required>
                                        <select v-model="element.type">
                                            <option value="frontend">Fronend</option>
                                            <option value="backend">Backend</option>
                                            <option value="cms">CMS</option>
                                            <option value="more">More</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Link</span>
                                    <input type="url" required class="input is-radiusless is-shadowless" v-model="element.link">
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
    
            <div class="column is-8" v-if="editing">
                <p class="subtitle has-text-grey">Edit {{element.name}} Expertie</p>
                <form @submit.prevent="onUpdateElement">
                    <table class="is-borderless table is-fullwidth is-bordered">
                        <tbody>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Name</span>
                                    <input type="text" required class="input is-radiusless is-shadowless" v-model="element.name">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Type</span>
                                    <div class="select is-fullwidth is-radiusless is-shadowles" required>
                                        <select v-model="element.type">
                                            <option value="frontend">Fronend</option>
                                            <option value="backend">Backend</option>
                                            <option value="cms">CMS</option>
                                            <option value="more">More</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <span class="m-b-5 is-block has-text-weight-semibold">Link</span>
                                    <input type="url" required class="input is-radiusless is-shadowless" v-model="element.link">
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <button type="submit" class="button is-primary has-text-weight-semibold is-radiusless is-shadowless">Save</button>
                                    <span class="button has-text-weight-semibold is-radiusless is-shadowless" @click="cancelEdit">Cancel</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    
    
            <div class="column is-8 m-t-50">
                <p class="subtitle has-text-grey">Experties</p>
                <table class="table table is-fullwidth is-bordered">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Type</td>
                            <td>Link</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(element, key) in elements">
                            <td>
                                {{element.name}}
                            </td>
                            <td>
                                {{element.type}}
                            </td>
                            <td>
                                <a :href="`http://${element.link}`" target="_blank">{{element.link}}</a>
                            </td>
                            <td>
                                <button class="button is-success is-small is-radiusless is-shadowless" @click="editElement(key,element.id, element.name, element.type, element.link)">Edit</button>
                            </td>
                            <td>
                                <button class="button is-danger is-small is-radiusless is-shadowless" @click="confirmdelete(key,element.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table> 
    
            </div>
    
    
    
    
    
    
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                element: {
                    name: "",
                    type: 'frontend',
                    link: "http://"
                },
                date: new Date(),
                elements: [],
                editing: false,
                elementId: ""
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            } else {
                this.getElements();
            }
        },
        methods: {
            getElements() {
                axios.get(`/api/experties`)
                    .then(response => {
                        this.elements = response.data.data
                    });
            },
            onSubmitElement() {
                axios.post(`/api/experties`, {
                        name: this.element.name,
                        type: this.element.type,
                        link: this.element.link
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Element Added Successfully',
                            type: 'is-success'
                        });
                    })
                this.getElements()
                this.element = {}
            },
            cancelEdit() {
                this.editing = false
                this.element = {
                    name: "",
                    type: "frontend",
                    link: "http://"
                }
            },
            editElement(key, id, name, type, link) {
                this.editing = true
                this.elementId = id
                this.element.name = name
                this.element.type = type
                this.element.link = link
            },
            onUpdateElement() {
                axios.put(`/api/experties/${this.elementId}`, {
                        name: this.element.name,
                        link: this.element.link,
                        type: this.element.type
                    })
                    .then(response => {
                        this.getElements()
                        this.element.name = ""
                        this.element.link = "http://"
                        this.element.type = "frontend"
                        this.elementId = ""
                        this.editing = false

                        this.$toast.open({
                            duration: 800,
                            message: 'Element Updated Successfully',
                            type: 'is-success'
                        });
                    })
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
                axios.delete(`/api/experties/${id}`)
                    .then((response) => {
                        this.elements.splice(key, 1);
                        this.$toast.open({
                            duration: 2000,
                            message: `Element Delete Successfully`,
                            type: 'is-success'
                        });
                    })
            }
        }
    
    }
</script>

<style>
    
</style>
