<template>

            <v-card class="mt-2">

                <v-card-title primary-title>
                    <h3 class="headline mb-0">
                        <router-link :to="question.path">
                            {{question.title}}
                        </router-link>
                    </h3>
                    <br>
                    <div class="grey--text">
                        {{question.user}} Asked
                        {{question.created_at}}
                    </div>
                </v-card-title>

                <v-card-text>{{question.body}}</v-card-text>
            </v-card>

</template>

<script>
    export default {
        name: "Question",
        props:['question']
    }
</script>

<style scoped>

</style>