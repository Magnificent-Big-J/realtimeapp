<template>
    <v-form
            @submit.prevent="signup"
    >


        <v-text-field
                v-model="form.name"
                label="Name"
                type="text"
                required
        ></v-text-field>
        <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
        <v-text-field
                v-model="form.email"
                label="E-mail"
                type="email"
                required
        ></v-text-field>
        <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>
        <v-text-field
                v-model="form.password"
                type="password"
                label="Password"
                required
        ></v-text-field>
        <span class="red--text" v-if="errors.name">{{errors.password[0]}}</span>
        <v-text-field
                v-model="form.password_confirmation"
                type="password"
                label="Password Confirmation"
                required
        ></v-text-field>


        <v-btn
                color="green"
                type="submit"
        >
            Sign Up
        </v-btn>
        <router-link to="/login">
            <v-btn color="blue">Login</v-btn>
        </router-link>
    </v-form>
</template>

<script>
    export default {
        name: "SignUp",
        data(){return{
            form:{
                name:'',
                email:'',
                password:'',
                password_confirmation:''
            },
            errors:{}
        }},
        methods:{
            signup(){
                axios.post('/api/auth/signup',this.form)
                    .then((response) =>{
                        User.responseAfterLogin(response)
                        this.$router.push({name:'forum'})
                    })
                    .catch((error)=>{
                        this.errors = error.response.data.errors
                        console.log(this.errors)
                    })

            }
        },
        created(){
            this.$router.push({name:'forum'})
        }
    }
</script>

<style scoped>

</style>