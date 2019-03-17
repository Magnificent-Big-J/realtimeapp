<template>
    <v-card>
        <v-container>
            <v-card-title>
                <div>
                    <div class="headline">
                        {{question.title}}
                    </div>
                    <span class="grey--text">{{question.user }} Asked {{question.created_at}}</span>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="teal">{{question.reply_count}}</v-btn>
            </v-card-title>
            <v-card v-html="body"></v-card>
            <v-card-actions v-if="own">
                <v-btn icon small  @click="edit">
                    <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon small @click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>

            </v-card-actions>
        </v-container>
    </v-card>
</template>

<script>

    export default {
        name: "ShowQuestion",
        props:['question'],
        data(){return{


        }},
        computed:{
            body(){
                return md.parse(this.question.body)
            },
            own(){
                return User.own(this.question.user_id)
            },

        },
        methods:{
            destroy(){
                axios.delete(`/api/question/${this.question.slug}`)
                    .then((response)=>{
                        this.$router.push('/forum')
                    })
                    .catch((error)=>{
                        console.log(error.response.data)
                    })
            },
            edit(){
                EventBus.$emit('startEditing')
            }
        }

    }
</script>

<style scoped>

</style>