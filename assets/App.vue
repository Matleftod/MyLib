<script lang="ts">
import Header from './components/Header.vue'

export default {
  name: 'App',
  components:{
    Header,
  }
}
</script>

<template>
  <Header />
  <nav>
    <router-link to="/">Acceuil</router-link> |
    <router-link to="/about">About</router-link>
    <!--<router-link to="/login">Login</router-link>-->
  </nav>
  <router-view></router-view>
</template>