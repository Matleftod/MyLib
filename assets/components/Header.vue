<template>
  <container class="header-container">
    <div class="header">
      <div class="header-logo">
        <a href="/">
          <img src="../assets/Logo4W.png" alt="logo">
        </a>
      </div>
      <div class="header-account">
        <div v-if="email !== 'none' && !isPremium" class="premium">
          <stripe/>
        </div>
        <div v-if="email !== 'none'" class="header-profile"> 
          <p class="header-user-title">User Profile</p>
          <router-link to="/account">
            <h5 class="header-user-name">{{ email }}</h5>
          </router-link>
        </div>
        <div v-if="email === 'none'">
          <a href="/api/login">Login | </a>
          <a href="/api/register">Register</a>
        </div>     
        <div v-else>      
          <a href="/api/logout">Logout</a>
        </div>     
      </div>
    </div>    
  </container>
</template>

<script lang="ts">
import Stripe from './Stripe.vue'
export default {
  name: 'Header',
  components: {
    Stripe,
  },
  data(){
    return {
      isPremium: false,
      email: 'none',
    }
  },
  created(){
    fetch('/api/authenUser',{
      method: 'GET'
    })
    .then(response => response.json())
    .then(user => {
      this.email = user.email
      this.isPremium = user.is_premium
    })
  }
}
</script>

<style scoped>
.header-container{
  width: 100%;
  background-color: #1f1f1f;
}
.header{
  margin: 15px;
  display: flex;
  justify-content: space-between;
}
.header-account{
  display: flex;
  align-items: center;
}

.header-profile{
  margin-right: 10px;
  margin-left: 10px;
}

.header-user-title, .header-user-name{
  margin: 0px;
}

.header-logo img{
  max-width: 160px;
}
</style>
