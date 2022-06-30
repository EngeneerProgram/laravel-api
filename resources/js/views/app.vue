<template>

    <main>
    <div class="container-fluid">
        <div class="row">

        <section class="posts pt-5 col-12 col-md-9 col-lg-10">

            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <div class="col" v-for="post in postsResponse.data" :key="post.id">
                        <div class="product card">
                            <img class="img_fluid" :src="'storage/' + post.cover_image" :alt="post.title">
                            <div class="card-body">
                                <h3>{{ post.title }}</h3>
                                <p>{{ trimText(post.content) }}</p>
                                <a href="#">Read more</a>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <div class="author" v-if="post.user">
                                            <h5>Author</h5>
                                            {{ post.user.name }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div v-if="post.category">
                                            <strong>Category: </strong> {{ post.category.name }}
                                        </div>
                                        <div class="py-2" v-if="post.tags.length > 0">
                                            <strong>Tags: </strong>
                                            <ul>
                                                <li v-for="tag in post.tags" :key="tag.id">
                                                    {{ tag.name }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav aria-label="Page navigation" class="py-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" v-if="postsResponse.current_page > 1">
                            <a class="page-link" href="#" aria-label="Previous" @click.prevent="getAllPosts(postsResponse.current_page - 1)">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                        </li>
                        
                        <li :class="{'page-item' : true, 'active' : page == postsResponse.current_page}" v-for="page in postsResponse.last_page" :key="page.index">

                            <a class="page-link" href="#" @click.prevent="getAllPosts(page)">
                                {{page}}
                            </a>
                        </li>

                        <li class="page-item" v-if="postsResponse.current_page < postsResponse.last_page">
                            <a class="page-link" href="#" aria-label="Next" @click.prevent="getAllPosts(postsResponse.current_page + 1)">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
            </div>
        </section>

        <aside class="bg-white p-2 col-12 col-md-2 col-lg-2">
            <div class="widget">
                <div class="categories pt-5">
                    <h3>Categories</h3>
                    <ul class="text-white">
                        <li v-for="category in categories" :key="category.id">
                            {{category.name}}
                        </li>
                    </ul>
                </div>
    
                <div class="tags pt-5">
                    <h3>Tags</h3>
                    <ul class="text-white">
                        <li v-for="tag in tags" :key="tag.id">
                            {{tag.name}}
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        </div>
    </div>
        

    </main>

</template>

<script>


export default {
    name: 'App',
    components: {},
    data() {
        return {
            /* posts: '', */
            postsResponse: '',
            categories: '',
            tags: '',

        }
    },
    methods: {

        getAllPosts(PostPage) {

            axios
                .get('/api/posts', {
                    params:{
                        page: PostPage
                    }
                })
                .then((response) => {
                    console.log(response);
                    /* this.posts = response.data.data */
                    this.postsResponse = response.data
                }).catch(e => {
                    console.error(e);
                })
        },

        getAllCategories() {
            axios.get('/api/categories')
            .then((response) => {
                    console.log(response);
                    this.categories = response.data
                   
                }).catch(e => {
                    console.error(e);
                })
        },

         getAllTags() {
            axios.get('/api/tags')
            .then((response) => {
                    console.log(response);
                    this.tags = response.data
                   
                }).catch(e => {
                    console.error(e);
                })
        },

        trimText(text) {
            if(text.length > 100) {
                return text.slice(0, 100) + '...'
            } else {
                return text;
            }
        }
    },
    mounted() {

        this.getAllPosts(1)
        this.getAllCategories()
        this.getAllTags()

    }
}

</script>

<style lang="scss">

    aside {
        .widget {
            margin-bottom: 1rem;
            padding: 0.25rem;
            border-radius: 1rem;
            background-color: rgb(230, 217, 217);
        }
    }
</style>
