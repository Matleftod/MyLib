<template>
    <div class="container-thanks">
        <h1>
            Thank you for your purchase !
        </h1>
        <button @click="redirectToHome()">
            GO TO HOME
        </button>
    </div>
  </template>
  
  <script lang="ts">
  export default {
    name: 'Thanks',
    methods: {
        redirectToHome() {
        this.$router.push({ path: '/' });
        }
    }
  }
  </script>
  
  <style scoped>
  .container-thanks{
    text-align: center;
    padding-top: 200px;
  }
  </style>
  