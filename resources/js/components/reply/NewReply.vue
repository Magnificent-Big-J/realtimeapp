<template>
    <div class="mt-2">
        <markdown-editor v-model="form.body"></markdown-editor>
        <v-btn color="green" dark @click="reply">
            Reply
        </v-btn>
    </div>
</template>

<script>
    export default {
        name: "NewReply",
        props:['questionSlug'],
        data(){return{
            form:{body:null}
        }},
        methods:{
            reply(){
                axios.post(`/api/question/${this.questionSlug}/reply`,this.form)
                    .then((response)=>{

                        EventBus.$emit('newReply',response.data.reply)
                        this.body = ''
                        window.scrollTo(0,0)
                    })
                    .catch((error)=>{
                        console.log(error.response.data)
                    })
            }
        }
    }
</script>

<style scoped>

</style>