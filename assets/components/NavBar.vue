<template>
    <conatiner class="navbar-container">
        <ul>
            <li><router-link to="/">Acceuil</router-link></li>
            <li><router-link to="/books">Books</router-link></li>
            <li><router-link to="/about">About</router-link></li>
        </ul>
    </conatiner>
</template>
  
<script lang="ts">
export default {
    name: 'NavBar',
}
</script>

<style scoped>
.navbar-container{
    display: flex;
    width: 20%;
    height: 100vh;
    background-color: rgb(49, 48, 50);
}
</style>
  