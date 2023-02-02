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
    <div class="inside-body">
      <router-view></router-view>
    </div>
  </div>  
  <div class="footer">

  </div>
</template>

<style scoped>
  .header{
    display: flex;
    position: fixed;
    width: 100%;
    z-index: 9999;
  }

  .navbar{
    display: flex;
    position: fixed;
    width: 100%;
    top: 78px;
  }
  .body{
    position: relative;
    top: 78px;
    left: 20%;
    width: 80%;
  }

  .inside-body{
    padding: 10px;
    padding-bottom: 40px;
  }
  </style>
