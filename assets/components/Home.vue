<template>
  <div>
    <h3>User Profile</h3>
    <ul>
      <li>{{ email }}</li>
    </ul>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Home',
  data(){
    return {
      email: 'none',
    }
  },
  created(){
    fetch('authenticated-user')
      .then(response => response.json())
      .then(user => {
        console.log("user: "+ user)
        this.email = user.email
      })
  }
}
</script>

<style scoped>
.read-the-docs {
  color: #888;
}
</style>
