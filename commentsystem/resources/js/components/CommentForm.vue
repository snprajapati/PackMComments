<template>
    <form>
        <label>Name</label><br/>
        <input type="text" v-model="user">
        <br/>
        <label>Comment</label><br/>
        <textarea name="content" v-model="content"></textarea>
        <br/><br/>
        <button type="button" name="post" v-on:click="reply((comment) ? comment.id : null)">Post</button>
    </form>
</template>
<script>
    const axios = require('axios');
    export default{
        props: ["comment", { "replyTo" : { type: Function }}],
        data(){
            return{
                content: '',
                user: '',
            }
        },
        methods:{
            reply(comment) {
                let data = {
                    content: this.content,
                    post_id: 1,
                    parent_id: comment,
                    user:this.user 
                };
                this.content = '';
                this.user = '';
                // Getting Nested Parent
                const parent = getParent(this.$parent);
                parent.replyTo(data);

            }
        }
    }
    
    function getParent(parent){
        if(typeof parent.replyTo === 'function') {
            return parent;
        }else{
            return getParent(parent.$parent);
        }
    }

</script>