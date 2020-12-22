<template>
<div style="width:60%">
    <h1>This is sample Post</h1>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
     Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
      when an unknown printer took a galley of type and scrambled it to make a type 
      specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <h3>Comments</h3>
    <comment-form></comment-form>
    <div id="alertMessage">
    {{ msg }}
    </div>
    <ul class="list-group">
        <li v-for="comment in comments">
            <b>{{ comment.user }}:</b> {{ comment.content }}
            <a @click="replyToComment = comment" href="javascript::void()">Reply</a>
            <comment-form v-if="replyToComment == comment" :comment="comment" ></comment-form>
            <comment-list v-if="comment.children.length != 0" :comment="comment.children" :depath=0></comment-list>
        </li>
    </ul>
</div>   
</template>
<script>
    const axios = require('axios');
    import CommentForm from '../components/CommentForm';
    import CommentList from '../components/CommentList';
    export default {
        data(){
            return {
                comments:[],
                msg:'',
                replyToComment: false
            }
        },
        computed: {
        },
        mounted(){
            this.getComments();
        },
        components: {
            'comment-form': CommentForm,
            'comment-list':CommentList
        },
        methods: {
            getComments(){
                axios.get('/api/comments').then(response => {
                    this.comments = response.data.data;
                });
            },
            replyTo(comment) {
                axios.post('/api/comment', comment).then(response => {
                  console.log(response);
                  this.msg = response.data.message;
                  document.getElementById('alertMessage').style.color = 'green'
                  this.getComments();
                }).catch(error=>{
                    this.msg = error.response.data.message;    
                   document.getElementById('alertMessage').style.color = 'red'
                });
            }
        }
    }
</script>