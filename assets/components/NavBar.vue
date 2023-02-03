<template>
    <conatiner class="navbar-container">
        <ul>
            <li>
                <router-link to="/">
                    <i class="fa-solid fa-house"></i>
                    Home
                </router-link>
            </li>
            <li>
                <router-link to="/books">
                    <i class="fa-solid fa-book"></i>
                    Books
                </router-link>
            </li>
            <li>
                <router-link to="/mybook">
                    <i class="fa-solid fa-book"></i>
                    My Books
                </router-link>
            </li>
            <li>
                <router-link to="/about">
                    <i class="fa-solid fa-circle-question"></i>
                    About
                </router-link>
            </li>
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
    width: 100%;
    height: 100vh;
    background-color: rgb(27 27 27);
}
.navbar-container ul{
    width: 100%;
    padding: 0;
    margin-left: 10px;
    margin-right: 10px;
}

.navbar-container li{
    
    margin-bottom: 15px;
}

.navbar-container i{
    min-width: 18px;
}

.navbar-container a{
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    color: white;
    padding: 7px 0px 7px 0px;
}
.navbar-container li:hover a, .navbar-container a.router-link-active{
    color: #ae1045;
    background-color: rgb(46, 45, 45);
    border-radius: 8px;
}
</style>
  