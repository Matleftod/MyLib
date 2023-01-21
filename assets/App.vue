<script lang="ts">
import Header from './components/Header.vue'
import NavBar from './components/NavBar.vue';

export default {
  name: 'App',
  components:{
    Header,
    NavBar,
  }
}
</script>

<template>
  <div class="header">
    <Header />
  </div>
  <div class="navbar">
    <NavBar />
  </div>

  <div class="body">
    <nav>
      <router-link to="/">Acceuil</router-link> |
      <router-link to="/about">About</router-link>
      <!--<router-link to="/login">Login</router-link>-->
    </nav>
    <router-view></router-view>
  </div>  
  <div class="footer">

  </div>
</template>

<style scoped>
  .header{
    display: flex;
    position: fixed;
    width: 100%;
  }

  .navbar{
    display: flex;
    position: fixed;
    width: 100%;
    top: 78px;
  }
  .body{
    display: flex;
    position: relative;
    top: 78px;
    left: 20%;
  }
  </style>
