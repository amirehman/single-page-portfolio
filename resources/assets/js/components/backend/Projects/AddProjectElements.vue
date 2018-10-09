<template>
    <div>
        <div class="column is-8 m-t-20">
    
    
            <span class="m-b-5 is-block has-text-weight-semibold">Project Elements</span>
            <div class="project-elements box is-radiusless is-shadowless">
                <span class="tag is-large">
                                                    PHP Laravel
                                                    <button class="delete"></button>
                                                </span>
            </div>
    
            <div class="add-element-input m-t-15">
                <form @submit.prevent="addingElement" method="post">
                    <span class="m-b-5 is-block has-text-weight-semibold">Add Element</span>
                    <input type="text" class="input is-radiusless is-shadowless" v-model="element" placeholder="start typing...">
                </form>
            </div>
            {{elements}}
        </div>
    </div>
</template>


<script>
    export default {
        props: ['projectId'],
        data() {
            return {
                elements: [],
                element: ""
            }
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            } else {
                setTimeout(() => {
                    axios.get(`/api/projects/${this.projectId}/elements`)
                        .then(response => {
                            this.elements = response.data.elements
                        });
                }, 500)
            }
    
        },
        methods: {
            addingElement() {
                axios.post(`/api/projects/${this.projectId}/elements`, {
                        element: this.element
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 800,
                            message: 'Element Updated Successfully',
                            type: 'is-success'
                        });
                    })
                    this.element = ""
            }
        }
    }
</script>


<style scopped>
    .project-elements {
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
</style>