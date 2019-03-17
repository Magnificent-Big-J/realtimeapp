<template>
   <div>
      <toolbar></toolbar>
      <router-view></router-view>
      <appfooter></appfooter>
   </div>
</template>

<script>
    import toolbar from '../components/Toolbar'
    import appfooter from '../components/AppFooter'

    export default {
        name: "AppHome",
        components:{
            toolbar, appfooter
        }
    }
</script>

<style scoped>

</style>