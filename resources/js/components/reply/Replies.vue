<template>
    <div>
        <reply v-if="content" v-for="reply,index in content" :index="index" :reply="reply" :key="reply.id"></reply>
    </div>

</template>

<script>
    import reply from './Reply'
    export default {
        name: "Replies",
        props:['question'],
        components:{reply},
        data(){return{

        }},
        methods:{
            listen(){
                EventBus.$on('newReply',(reply)=>{
                    this.replies.unshift(reply)
                })
                EventBus.$on('deleteReply',(index)=>{
                    axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
                        .then((response)=>{
                            this.content.splice(index,1)
                        })
                })
            }
        },
        created() {
            this.listen()
        },
        computed:{
            content(){
               return this.question.replies
            }
        }
    }
</script>

<style scoped>

</style>