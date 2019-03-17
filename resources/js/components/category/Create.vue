<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-text-field
                    v-model="form.name"
                    label="Category Name"
                    type="text"
                    required
            ></v-text-field>
            <v-btn type="submit" color="pink" v-if="editSlug">
                Update
            </v-btn>
            <v-btn type="submit" color="teal" v-else>
                Create
            </v-btn>
        </v-form>
        <v-card>
            <v-toolbar color="indigo" dense>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>
            <v-list>
                <div v-for="category, index in categories" :key="category.id">
                    <v-list-tile >
                        <v-list-tile-action>
                            <v-btn icon small @click="edit(index)">
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>

                        </v-list-tile-action>

                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{category.name}}
                            </v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>

                            <v-btn icon small @click="destroy(category,index)">
                                <v-icon color="red">delete</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-divider></v-divider>
                </div>
            </v-list>
        </v-card>
    </v-container>

</template>

<script>
    export default {
        name: "Create",
        data(){return{
            form:{name:null},
            categories:{},
            editSlug: null
        }},
        methods:{
            submit(){

                this.editCategory ? this.update() : this.create()


            },
            getCategories(){
                axios.get('/api/category')
                    .then((response)=>{
                        this.categories = response.data.data
                    })
                    .catch((error)=>{
                        console.log(error.response.data)
                    })
            },
            destroy(category,index){
                axios.delete(`/api/category/${category.slug}`)
                    .then((response)=>{
                        this.categories.splice(index,1)
                    })
                    .catch((error)=>{
                        console.log(error.response.data)
                    })
            },
            edit(index){
                this.form.name = this.categories[index].name
                this.editSlug = this.categories[index].slug
                this.categories.splice(index,1)
            },
            create(){
                axios.post('/api/category',this.form)
                    .then((response)=>{
                        this.categories.unshift(response.data)
                        this.form.name = null
                    })
                    .catch((error)=>{
                        console.log(error.response.data)
                    })
            },
            update(){
                    axios.patch(`/api/category/${this.editSlug}`,this.form)
                        .then((response)=>{

                        })
                        .catch((error)=>{
                            console.log(error.response.data)
                        })

            }
        },
        created(){
            if(!User.admin()){
                this.$router.push('/forum')
            }
            this.getCategories()
        }
    }
</script>

<style scoped>

</style>