<template>
    <div class="row justify-content-center">
        <div class="card" style="margin-bottom: 15px;">
            <div class="card-body">
                <h5 class="card-title">{{ article.title }}</h5>
                <p class="card-text">{{ article.text }}</p>
            </div>
        </div>

        <div class="card" style="margin-bottom: 14px; width: 100%">
            <div class="card-body" id="comment-body">
                <h5 class="card-title">Comments</h5>
                <div style="display: flow-root">
                    <form @submit.prevent="addComment">
                        <div class="form-group">
                            <textarea type="text" class="form-control" placeholder="Comment"
                                v-model="newComment.comment"
                            ></textarea>
                        </div>
                        <button type="submit" :disabled="isDisabled" class="btn btn-success float-right"> save </button>
                    </form>
                </div>
                <div style="margin: 5px 0;" v-for="comment in comments" :key="comment.id">
                    <p class="card-text" style="padding: 10px; background-color: #fafafa;border-radius: 5px;">
                        {{ comment.comment }}
                    <button @click="deleteComment(comment.id)" v-show="comment.user_id.id === newComment.user_id" class="btn btn-danger btn-sm float-right mr-2">Delete</button>

                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            userId: String
        },
        data(){
            return {
                comments: [],
                newComment: {
                    comment: '',
                    article_id: '',
                    user_id: ''
                },
                article: {},
                pagination: {},
                edit: false,
                isDisabled: false
            }
        },
        created(){
            this.setInfo();
            this.fetchArticle();
            this.fetchComments();
        },
        methods: {
            fetchArticle(){
                let page_url = 'http://127.0.0.1:8000/api/articles/'+this.newComment.article_id;
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.article = res.data;
                })
                .catch(err => console.log(err))
            },
            fetchComments(){
                
                let page_url = 'http://127.0.0.1:8000/api/articles/'+this.newComment.article_id+'/comments'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.comments = res.data;
                })
                .catch(err => console.log(err))
            },
            deleteComment(comment_id){
                if(confirm('Are you Sure?')){
                    let page_url = 'http://127.0.0.1:8000/api/comments/'+comment_id;
                    fetch(page_url, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(res => {
                        this.fetchComments();
                    })
                    .catch(err => console.log(err))
                }
                
            },
            addComment(){
                if(this.edit === false){
                    let page_url = 'http://127.0.0.1:8000/api/comments';
                    fetch(page_url, {
                        method: 'post',
                        body: JSON.stringify(this.newComment),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        this.newComment.comment = ''
                        this.fetchComments();
                    })
                    .catch(err => console.log(err))
                }else{

                }
            },
            setInfo(){
                let url = window.location.href;
                let lastParam = url.split("/").slice(-1)[0];
                this.newComment.article_id = lastParam;
                this.newComment.user_id = this.$attrs['userid'];
                if(this.$attrs['userid'] === 0){
                    this.isDisabled = true;
                }
            }

        }
    }
</script>