<template><v-form
        @submit.prevent="login"
>


    <v-text-field
            v-model="form.email"
            label="E-mail"
            type="email"
            required
    ></v-text-field>
    <v-text-field
            v-model="form.password"
            type="password"
            label="password"
            required
    ></v-text-field>




    <v-btn
            color="green"
            type="submit"
    >
        Login
    </v-btn>
    <router-link to="/signup">
        <v-btn color="blue">Signup</v-btn>
    </router-link>
</v-form>

</template>

<script>
    export default {
        name: "Login",
        data(){return{
            form:{email:'', password:''}
        }},
        methods:{
            login(){
                User.login(this.form)

            }
        },
        created(){
            //this.$router.push({name:'forum'})
        }
    }
</script>

<style scoped>

</style>