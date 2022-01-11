import { createStore } from 'vuex'
import axios from 'axios'

axios.defaults.baseURL = window.location.origin + '/api'

export default createStore({
    state: {
        user: null
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },

        clearUserData() {
            localStorage.removeItem('user')
            location.reload()
        }
    },

    actions: {
        signIn({ commit }, credentials) {
            return axios
                .post('/signin', credentials)
                .then(({ data }) => {
                    commit('setUserData', data)
                   
                    let user = data.user

                    console.log('data.user', data);
                    if(data.status == true){

                        window.location.href = window.location.origin+'/admin'
                        
                    }
                     
                      
                })
        },

        signOut({ commit }, userData) {
            commit('clearUserData')

           return axios.post('/signout', userData)
           .then(res=>{

           })
        }
    },

    getters: {
        isLogged: state => !!state.user,
        user: state => state.user,
        
    }
})
