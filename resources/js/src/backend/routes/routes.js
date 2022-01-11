import Home from '../../../components/backend/views/Home.vue'
import SignIn from '../../../components/backend/views/auth/SignIn.vue'
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