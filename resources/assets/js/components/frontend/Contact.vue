<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="contact-wrapper">
            <div class="container">
                <div class="columns">
                    <div class="column is-8">
                        <div class="contact-header">
                            <div class="content">
                                <h3>LET'S HAVE A CHAT </h3>
                                <p class="has-text-grey is-paddingless is-size-6">Reach out and send me a friendly hello.</p>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum accusantium voluptatibus numquam minus dolor porro quisquam ratione quibusdam, labore, saepe est consequuntur reiciendis harum doloremque, esse dolore laudantium.
                                    Non, exercitationem.</p>
                            </div>
                        </div>
    
                        <div class="contact-body">
                            <div class="columns">
                                <div class="column is-8">
                                    <form @submit.prevent="onSubmitContact">
    
                                        <div class="field">
                                            <label class="label has-text-weight-semibold is-uppercase is-size-7">Full Name *</label>
                                            <div class="control">
                                                <input class="input is-shadowless is-radiusless" v-model="contact.name" type="text">
                                            </div>
                                        </div>
    
                                        <div class="field">
                                            <label class="label has-text-weight-semibold is-uppercase is-size-7">Email *</label>
                                            <div class="control">
                                                <input class="input is-shadowless is-radiusless" v-model="contact.email" type="email">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label has-text-weight-semibold is-uppercase is-size-7">Subject *</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select class="is-shadowless is-radiusless" v-model="contact.subject">
                                                            <option value="select" selected disabled>Select dropdown</option>
                                                            <option value="option">With options</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label has-text-weight-semibold is-uppercase is-size-7">Message</label>
                                            <div class="control">
                                                <textarea class="textarea  is-shadowless is-radiusless" v-model="contact.message"></textarea>
                                            </div>
                                        </div>
    
                                        <div class="field">
                                            <div class="control">
                                                <button class="button  is-radiusless is-warning has-text-weight-semibold is-size-6">SUBMIT</button>
                                            </div>
                                        </div>
    
                                    </form>
    
                                    <div class="is-divider" data-content="OR"></div>
    
                                    <div class="has-text-centered">
                                        <h5 class="is-size-5 has-text-grey">write to
                                            <a href="mailto:hi@amirrehman.com" class="email-link">hi@amirrehman.com</a>
                                        </h5>
                                    </div>
    
    
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <footer-bottom></footer-bottom>
    
    </div>
</template>


<script>
    import footer from "./Footer";
    import navbar from "./TopNav";
    
    export default {
        data() {
            return {
                contact: {
                    subject: "select"
                },
                errors: {}
            }
        },
        methods: {
            onSubmitContact() {
                axios.post(`/api/xigmig/contact`, {
                        name: this.contact.name,
                        email: this.contact.email,
                        subject: this.contact.subject,
                        message: this.contact.message
                    })
                    .then(response => {
                        this.$toast.open({
                            duration: 8000,
                            message: 'Message send successfully',
                            type: 'is-success'
                        });
                    })
    
    
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar
        }
    
    }
</script>


