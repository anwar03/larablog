<template>
    <div class="row justify-content-center">
        <div class="col-md-8 col-offset-md-2" v-for="article in articles" :key="article.id">
            <div class="card mb-3" >
                <div class="card-body">
                    <a class="page-item" style="cursor: pointer;" @click="articleDetails(article.id)">
                        <h5 class="card-title">{{ article.title }}</h5>
                    </a>
                    <p class="card-text">{{ article.text }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-offset-md-2">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
                        <a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a>
                    </li>
                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page}} of {{ pagination.last_page }}</a></li>
                    <li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="page-item">
                        <a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                articles: [],
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                article_id: '',
                pagination: {},
                edit: false
            }
        },
        created(){
            this.fetchArticles();
        },
        
        methods: {
            fetchArticles(page_url){
                let vm = this;
                page_url = page_url || '/api/articles'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.articles = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err))
            },
            makePagination(meta, links){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },
            articleDetails(id){
                let url= 'http://127.0.0.1:8000/article/'+id;
                window.location.href=url;
            }

        }
    }
</script>