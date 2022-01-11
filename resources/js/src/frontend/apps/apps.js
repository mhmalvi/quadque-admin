require('../../../bootstrap')
import {createApp, h} from 'vue'
import axios from 'axios'
import master from '../../../components/frontend/layouts/Master.vue'
import router from '../routes/routes-config'
import store from '../store/store'

const app = createApp({
    created() {
        const userInfo = localStorage.getItem("user");
        if (userInfo) {
            const userData = JSON.parse(userInfo);
            this.$store.commit("setUserData", userData);
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('singOut')
                }
                return Promise.reject(error)
            }
        )
    },
    render:()=>h(master)
})

app.provide('base_url', window.location.origin)

let userInfo = localStorage.getItem('user')
let user = JSON.parse(userInfo)
app.provide('user', user)
app.use(store)
app.use(router)
app.mount("#app_frontend")