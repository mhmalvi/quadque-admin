import Home from '../../../components/frontend/views/Home.vue'
import SignIn from '../../../components/frontend/views/auth/SignIn.vue'
let routes = [
    {
        path:'/',
        name:'Home',
        component:Home,
        meta:{
            auth:true
        }
    },
    {
        path:'/signin',
        name:'SignIn',
        component:SignIn,
        meta:{
            auth:false
        }
    },
]

export default routes