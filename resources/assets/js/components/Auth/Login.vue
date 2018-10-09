<template>
    <div>
            <div class="container  m-t-0">
                <div class="column is-4">
                    <p class="subtitle has-text-grey">Login to proceed....</p>
                    <div class="box is-radiusless">
                        <form @submit.prevent="login">
                           
                            <b-field>
                                <b-input 
                                v-model="form.email"
                                size="is-small"
                                placeholder="email">
                                </b-input>
                            </b-field>

                            <b-field
                                        type="is-success"
                                         message="This username is available">
                                <b-input type="password"
                                         v-model="form.password"
                                         placeholder="Password"
                                         value="iwantmytreasure"
                                         size="is-small"
                                         password-reveal>
                                </b-input>
                            </b-field>
                            
                            <button class="button is-block is-small">Login</button>
                        </form>
                    </div>
                    
                </div>
            </div>
    </div>
</template>

<script>


export default {
        data() {
            return {
                form: {
                    email: 'amir@icon-ad.com',
                    password: 'Letme@in'
                }
            }
        },
        created(){
            if (User.loggedIn()) {
                this.$router.push({
                    name: 'dashboard'
                })
            }

        },
        methods:{
            login(){
                User.login(this.form)
            }
        }
    }
</script>

<style>

</style>
