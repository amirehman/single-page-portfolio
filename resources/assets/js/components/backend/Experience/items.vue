<template>
    <div>
        <div class="column is-8">
            <hr />
            <template v-if="!editing">
            <form @submit.prevent="onSubmitExperienceList">
                <p class="subtitle has-text-grey">Add Item</p>
                <input type="text" class="input is-radiusless is-shadowless" v-model="element.name" required placeholder="add new list item to this experience">
                <p class="help is-danger" v-if="errors.item">{{errors.item[0]}}</p>                
            </form>
            </template>
            <template v-if="editing">
            <form @submit.prevent="onUpdateExperienceList">
                <p class="subtitle has-text-grey">Edit Item</p>
                <input type="text" class="input is-radiusless is-shadowless" v-model="element.name" required placeholder="You are editing element, don't leave this field blank">
                <p class="help is-danger" v-if="errors.item">{{errors.item[0]}}</p>
                <span class="button has-text-weight-semibold is-radiusless is-shadowless m-t-15" @click="cancelEdit">Cancel</span>
            </form>
            </template>
            <hr />
        </div>
        <div class="column is-8">
            <p class="subtitle has-text-grey">Items</p>
            <ul class="experience-list-items">
                <li v-for="(element, key) in elements"> {{element.name}} 
                    <button class="button is-small has-text-danger is-pulled-right m-l-15" @click="confirmdelete(key, element.id)">Delete</button> 
                    <button class="button is-small has-text-info is-pulled-right" @click="editElement(key, element.id, element.name)">Edit</button> 
                </li>
            </ul>
        </div>
    
    </div>
</template>

<script>
    export default {
        data() {
            return {
                element: {
                    name: ""
                },
                elements: [],
                elementId: "",
                editing: false,
                errors: ""
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            }else{
                setTimeout(() => {
                    this.getElements();
                }, 500)
            }
        },
        methods: {
            getElements() {
                axios.get(`/api/experiences/${this.$route.params.id}/items`)
                    .then(response => {
                        this.elements = response.data.data
                    });
            },
            onSubmitExperienceList() {
                axios.post(`/api/experiences/${this.$route.params.id}/items`, {
                        item: this.element.name,
                        experience_id: this.$route.params.id
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Item Added Successfully',
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
            editElement(key, id, name) {
                this.editing = true
                this.elementId = id
                this.element.name = name
            },
            onUpdateExperienceList() {
                axios.put(`/api/experiences/${this.$route.params.id}/items/${this.elementId}`, {
                        item: this.element.name
                    })
                    .then(response => {
                        this.getElements()
                        this.element.name = ""
                        this.$toast.open({
                            duration: 800,
                            message: 'Item Updated Successfully',
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
                axios.delete(`/api/experiences/${this.$route.params.id}/items/${id}`)
                    .then((response) => {
                        this.elements.splice(key, 1);
                        this.$toast.open({
                            duration: 2000,
                            message: `Item Delete Successfully`,
                            type: 'is-success'
                        });
                    })
            }
        }
    
    }
</script>

<style>
    
</style>
