<template>
    <v-form
            @submit.prevent="create"
    >


        <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
        ></v-text-field>
        <v-select
                :items="categories"
            label="Category"
            autocimplete
            v-model="form.category_id"
                item-text="name"
                item-value="id"

        >

        </v-select>

        <markdown-editor v-model="form.body"></markdown-editor>
        <v-btn
                color="green"
                type="submit"
        >
            Create
        </v-btn>

    </v-form>
</template>

<script>
    export default {
        name: "Create",
        data(){return{
            form:{title:null,category_id:null,body:null},
            categories:{},
            errors:{}
        }},
        methods:{
            create(){
                    axios.post('/api/question',this.form)
                        .then((response)=>{
                            //console.log(response.data.data)

                            this.$router.push(response.data.path)
                        })
            }
        },
        created() {
            axios.get('/api/category')
                .then((response)=>{
                    this.categories = response.data.data
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors
                })
        }
    }
</script>

<style scoped>

</style>