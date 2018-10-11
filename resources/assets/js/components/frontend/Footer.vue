<template>
    <footer class="footer is-paddingless m-t-75">
        <div class="container">
            <div class="content">
                <div class="getsocial">
                    <a class="gettitle">Get Social </a>
                    <a class="nottarget" :href="general.linkedin" target="_blank">
                        <i class="fa fa-linkedin"></i>
                    </a>
                    <a class="nottarget" :href="general.github" target="_blank">
                        <i class="fa fa-github"></i>
                    </a>
                    <a class="nottarget" :href="general.stackoverflow" target="_blank">
                        <i class="fa fa-stack-overflow"></i>
                    </a>
                    <a class="nottarget" :href="general.instagram" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a class="nottarget" :href="general.facebook" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <span> or email me direct at
                                    <a :href="profile.email">{{profile.email}}</a>
                                </span>
                </div>
    
            </div>
        </div>
    </footer>
</template>


<script>
    export default {
        data() {
            return {
                profile: {},
                general: {}
            }
        },
        created() {
            axios.get(`/api/general`)
                .then(response => {
                    this.general = response.data.data
                });
            axios.get(`/api/about`)
                .then(response => {
                    this.profile = response.data.data
                });
        }
    
    }
</script>