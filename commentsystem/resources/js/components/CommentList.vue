<template>
    <ul class="list-group">
        <li v-for="child in comment">
            <b>{{ child.user }} : </b>  {{ child.content }}
            <a v-if="depath < 1" @click="replyToComment = child" href="javascript::void()">Reply</a>
            <comment-form v-if="replyToComment == child" :comment="child"></comment-form>
            <comment-list v-if="child.children.length != 0" :comment="child.children" :depath="depath+1"></comment-list>
        </li>
    </ul>
</template>
<script>
    import CommentForm from '../components/CommentForm';
    export default{
        name: 'CommentList',
        props: ['comment','depath'],
        data(){
            return {
                replyToComment: false
            }
        },
        components: {
            'comment-form': CommentForm
        }
    }
</script>