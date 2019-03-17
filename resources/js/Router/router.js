import Vue from 'vue'
import  VueRouter from 'vue-router'

Vue.use(VueRouter)
import login from '../components/login/Login'
import signup from '../components/login/SignUp'
import logout from '../components/login/Logout'
import forum from '../components/forum/Forum'
import read from '../components/forum/Read'
import create from '../components/forum/Create'
import createCategory from '../components/category/Create'
const routes = [
    {path:'/login', component:login},
    {path:'/signup', component:signup},
    {path:'/logout', component:logout},
    {path:'/forum', component:forum,name:'forum'},
    {path:'/category', component:createCategory},
    {path:'/question/:slug', component:read,name:'read'},
    {path:'/ask', component:create,name:'create'},
]
const router = new VueRouter({
    routes,
    hashbang:false,
    mode:'history'
})

export default router