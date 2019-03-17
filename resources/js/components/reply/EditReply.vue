<template>
    <div>
        <markdown-editor v-model="reply.body"></markdown-editor>
        <v-card-actions >
            <v-btn icon small @click="update">
                <v-icon color="green">save</v-icon>
            </v-btn>
            <v-btn icon small @click="cancel">
                <v-icon color="black">cancel</v-icon>
            </v-btn>
        </v-card-actions>
    </div>
</template>

<script>
    export default {
        name: "EditReply",
        props:['reply'],
        methods:{
            cancel(){
                EventBus.$emit('canceling')
            },
            update(){
                axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,this.reply.body)
                    .then((response)=>{
                        this.cancel()
                    })
            }
        }
    }
</script>

<style scoped>

</style>