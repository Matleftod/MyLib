<template>
  <container class="header-container">
    <div class="header">
      <div class="header-logo">
        <a href="/">
          <img src="../assets/kisspng.jpg" alt="logo">
        </a>
      </div>
      <div class="header-account">
        <div class="header-profile">
          <p class="header-user-title">User Profile</p>
          <h5 class="header-user-name">{{ email }}</h5>
        </div>
        <div>
          <a href="/login">Login</a>
        </div>      
      </div>
    </div>    
  </container>
</template>

<script lang="ts">
export default {
  name: 'Header',
  data(){
    return {
      email: '',
    }
  },
  created(){
    fetch('/api/authenUser',{
      method: 'GET'
    })
    .then(response => response.json())
    .then(user => {
      this.email = user.email
    })
  }
}
</script>

<style scoped>
.header-container{
  width: 100%;
  background-color: rgb(48, 45, 45);
}
.header{
  margin: 15px;
  display: flex;
  justify-content: space-between;
}
.header-account{
  display: flex;
}

.header-profile{
  margin-right: 10px;
}

.header-user-title, .header-user-name{
  margin: 0px;
}
</style>
