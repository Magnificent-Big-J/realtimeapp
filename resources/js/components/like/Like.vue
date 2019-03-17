<template>
    <div>
        <v-btn icon @click="like">
            <v-icon :color="color">favorite</v-icon> <span>{{count}}</span>
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "Like",
        props:['content'],
        data(){return{
            liked:this.content.liked,
            count:this.content.like_count
        }},
        methods:{
            like(){
                if(User.loggedIn()){
                    this.liked ? this.decr() : this.incr()
                    this.liked = !this.liked
                }
            }
            ,
            incr(){
                axios.post(`/api/like/${this.content.id}`)
                    .then((response)=>{
                        this.count++
                    })
            },
            decr(){
                axios.delete(`/api/like/${this.content.id}`)
                    .then((response)=>{
                        this.count--
                    })
            }
        },
        computed:{
            color(){
                return this.liked ? 'red' : 'red lighten-4'
            }
        }
    }
</script>

<style scoped>

</style>