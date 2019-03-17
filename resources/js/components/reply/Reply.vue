<template>
   <div class="mt-2">
       <v-card>
           <v-card-title>
               <div class="headline">{{reply.user}}</div>
               <div class="ml-2">Relied {{reply.created_at}}</div>
               <v-spacer></v-spacer>
               <Like :content="reply"></Like>
           </v-card-title>
           <v-divider></v-divider>
           <EditReply v-if="editing" :reply="reply"></EditReply>
           <v-card-text v-else v-html="body"></v-card-text>
           <v-divider></v-divider>
           <div v-if="!editing">
               <v-card-actions v-if="own">
                   <v-btn icon small @click="edit">
                       <v-icon color="orange">edit</v-icon>
                   </v-btn>
                   <v-btn icon small @click="destroy">
                       <v-icon color="red">delete</v-icon>
                   </v-btn>
               </v-card-actions>
           </div>
       </v-card>
   </div>
</template>

<script>
    import EditReply from './EditReply'
    import Like from '../like/Like'
    export default {
        name: "Reply",
        props:['reply','index'],
        components:{EditReply,Like},
        data(){return{
            editing:false
        }},
        computed:{
            own(){
                return User.own(this.reply.user_id)
            },
            body(){
                return md.parse(this.reply.body)
            }
        },
        methods:{
            destroy(){
                EventBus.$emit('deleteReply',this.index)
            },
            edit(){
                this.editing = true

            }
            ,listen(){
                EventBus.$on('canceling',()=>{
                    this.editing = false
                })
            }
        },
        created() {
            this.listen()
        }
    }
</script>

<style scoped>

</style>