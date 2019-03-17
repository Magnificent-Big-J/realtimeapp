<template>
    <div>
        <editQuestion v-if="edit" :question="question"></editQuestion>
        <div v-else>
            <v-container>
                <showQuestion :question="question" v-if="question"></showQuestion>
                <replies :question="question"></replies>
                <newReply :questionSlug="question.slug"></newReply>
            </v-container>

        </div>
    </div>
</template>

<script>
    import showQuestion from './ShowQuestion'
    import editQuestion from './EditQuestion'
    import replies from '../reply/Replies'
    import newReply from '../reply/NewReply'

    export default {
        name: "Read",
        data(){return{
            question:{},
            edit: false
        }},
        components:{showQuestion, editQuestion,replies,newReply}
        ,
        created() {
            this.listen()
           this.getQuestion()
        },
        methods:{
            listen(){
                EventBus.$on('startEditing',()=>{
                    this.edit = true
                })

                EventBus.$on('cancelEditing',()=>{
                    this.edit = false
                })
            },
            getQuestion(){
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then((response)=>{
                        this.question = response.data.data

                    })
            }

        }
    }
</script>

<style scoped>

</style>