import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../components/App'
import PostComments from '../components/PostComments'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/post-comments',
            name: 'post-comments',
            component: PostComments,
            props: { title: "This is the SPA home" }
        },    
    ],
})
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});