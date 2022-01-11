import {createRouter, createWebHistory} from 'vue-router'
import axios from 'axios'
import routes from './routes'
axios.defaults.baseURL = window.location.origin

const router = createRouter({
 history:createWebHistory("/"),
 fallback:true,
 routes

})


router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
    const user = JSON.parse(localStorage.getItem('user'))

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        // next('/auth/signin')
        location.href = window.location.origin+'/signin'
        return
    } 
    // console.log('user', user); 
    
    next()

    
    
    
})

export default router
