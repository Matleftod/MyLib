<template>
    <conatiner class="navbar-container">
        <ul>
            <li>BTN 1</li>
            <li>BTN 2</li>
            <li>BTN 3</li>
            <li>BTN 4</li>
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
  