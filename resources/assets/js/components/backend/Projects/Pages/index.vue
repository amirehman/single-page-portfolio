<template>
    <div>
    
        <div class="container  m-t-0">
            <div class="column is-8">
                <p class="subtitle has-text-grey">{{project.title}} Pages
                    <small>
                                        <router-link :to="`/me/project/${projectId}/add-page`" class="button is-primary is-pulled-right is-small" >Add New Page</router-link>
                                    </small>
                </p>
    
    
                <div class="columns is-multiline">
                    <div class="column is-3" v-if="pages.length == 0">
                        No pages fournd.
                    </div>
                </div>
                    <draggable class="columns is-multiline" v-model="pages" :options="{group:'pages'}" @start="drag=true" @end="drag=false" @change="onChnage">
                    <div class="column pages-index-card is-3" v-for="(page, key) in pages">
                        <span class="delete-page" @click="confirmdelete(key, page.id)">✕</span>
                        <div class="card">
                            <router-link :to="`/me/project/${projectId}/page/${page.id}`">
                                <div class="card-image">
                                    <figure class="image">
                                        <img :src="`${baseURL}images/${page.image}`">
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        <div class="media-content">
                                            <p class="title is-7">({{key + 1}}) {{page.title}}  </p>
                                        </div>
    
                                    </div>
                                </div>
                            </router-link>
                        </div>
    
                    </div>
                    </draggable>    
            </div>
        </div>
    
    
    
    
    
    
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        props: ['projectId', 'projectSlug'],
        data() {
            return {
                project: "",
                pages: [],
                baseURL: "https://www.amirr.net/"
            }
        },
        components: {
            draggable,
        },
        created() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: 'login'
                })
            } else {
                setTimeout(() => {
                    this.getPages();
                }, 500)
            }
        },
        methods: {
            onChnage(evt) {
                let newPage = this.pages.map((page, index) => {
                    page.priority = index + 1;
                    return page;
                })
                axios.patch(`/api/projects/${this.projectId}/pages/update-all`, {
                        page: newPage,
                        project: this.project.id
                    })
            },
            getPages() {
                axios.get(`/api/projects/${this.projectId}/pages`)
                    .then(response => {
                        this.pages = response.data.pages
                    });
            },
            confirmdelete(key, id) {
                this.$dialog.confirm({
                    title: 'Are you sure?',
                    message: 'The page will be deleted permenently. kabi recover nahi kar pao ge.',
                    type: 'is-danger',
                    onConfirm: () => this.deletePage(key, id)
                });
            },
            deletePage(key, id) {
                axios.delete(`/api/projects/${this.$route.params.projectid}/pages/${id}`).then((response) => {
                    this.pages.splice(key, 1);
                    this.$toast.open({
                        duration: 2000,
                        message: `Page Deleted Successfully`,
                        type: 'is-success'
                    });
                    this.$router.push({
                        name: 'singleproject',
                        params: {
                            slug: response.data
                        }
                    })
                });
            }
        }
    }
</script>


<style scoped>
    .column {
        padding: 5px;
    }
    
    .media-content {
        padding: 0px;
    }
    
    .title {
        padding: 0px;
    }
</style>