<template>
    <div>
    
        <top-navbar></top-navbar>
    
        <div class="contact-wrapper">
            <div class="container pad-col">
                <div class="columns">
                    <div class="column is-8">
                        <div class="contact-header">
                            <div class="content">
                                <h1 class="title is-4 is-margin-less is-paddingless">LET'S HAVE A CHAT </h1>
                                <p class="has-text-grey is-margin-less is-paddingless title is-size-7">Reach out and send me a friendly hello.</p>
                                <!--<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum accusantium voluptatibus numquam minus dolor porro quisquam ratione quibusdam, labore, saepe est consequuntur reiciendis harum doloremque, esse dolore laudantium.
                                    Non, exercitationem.</p>-->
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
                                                <p class="help is-danger" v-if="errors.name">{{errors.name[0]}}</p>
                                            </div>
                                        </div>
    
                                        <div class="field">
                                            <label class="label has-text-weight-semibold is-uppercase is-size-7">Email *</label>
                                            <div class="control">
                                                <input class="input is-shadowless is-radiusless" v-model="contact.email" type="email">
                                                <p class="help is-danger" v-if="errors.email">{{errors.email[0]}}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label has-text-weight-semibold is-uppercase is-size-7">Subject *</label>
                                            <div class="control">
                                                <div class="select">
                                                    <select class="is-shadowless is-radiusless" v-model="contact.subject">
                                                            <option value="select" selected disabled>Select dropdown</option>
                                                            <option value="hiring">Hiring for a project</option>
                                                            <option value="question">Question </option>
                                                            <option value="other">Other </option>
                                                        </select>
                                                </div>
                                                <p class="help is-danger" v-if="errors.subject">{{errors.subject[0]}}</p>
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
                                                <button :disabled="isSubmitted" class="button is-radiusless is-warning has-text-weight-semibold is-size-6" :class="{ 'is-loading': isSubmitted}">SUBMIT</button>
                                            </div>
                                        </div>
    
                                    </form>
    
                                    <div class="is-divider" data-content="OR"></div>
    
                                    <div class="has-text-centered">
                                        <h5 class="is-size-5 has-text-grey">write to
                                            <a href="mailto:hi@amirrehman.com" class="email-link">hi@amirr.net</a>
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
                    subject: "hiring"
                },
                errors: {},
                isSubmitted: false
            }
        },
        methods: {
            onSubmitContact() {
                this.isSubmitted = true;
                axios.post(`/api/xigmig/contact`, {
                        name: this.contact.name,
                        email: this.contact.email,
                        subject: this.contact.subject,
                        message: this.contact.message
                    })
                    .then(response => {
                        this.isSubmitted = false;
                        this.$toast.open({
                            duration: 8000,
                            message: 'Message send successfully',
                            type: 'is-success'
                        });
                        this.contact.name = ""
                        this.contact.email = ""
                        this.contact.subject = "hiring"
                        this.contact.message = ""

                    })
                    .catch((error) => {
                        this.isSubmitted = false;
                        this.errors = error.response.data.errors
                    });
    
    
            }
        },
        components: {
            "footer-bottom": footer,
            "top-navbar": navbar
        }
    
    }
</script>


