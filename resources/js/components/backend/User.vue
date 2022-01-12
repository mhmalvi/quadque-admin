<template>
    <div>
        <h1>Hello world {{base_url}}</h1>
    </div>
</template>
<script>

import { inject } from 'vue'
export default {
    setup(){
        let base_url = inject('base_url')

        let getUser = ()=>{
            axios.get(base_url+'/api/get-user')
            .then(res=>{
                console.log(res.data);
            })
        }

        getUser()

        return{
            base_url,
            getUser
        }
    }
}
</script>