<script lang="ts">

export default {
  name: 'App',
  components:{
  }
}
</script>

<template>
  <nav>
    <router-link to="/">Acceuil</router-link> |
    <router-link to="/about">About</router-link> |
    <!--<router-link to="/login">Login</router-link>-->
  </nav>
  <router-view></router-view>
</template>