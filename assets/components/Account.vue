<template>
  <div>
    <h1 class="title">Your account
    </h1>
    <h2>
      E-mail : {{ email }}
    </h2>
    <h2 v-if="isPremium">
      Premium : Congrate Premium account !
    </h2>
    <h2 v-else>
      Premium : Nop noob !
    </h2>
    <button @click="setPremium">
      GO PREMIUM
    </button>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Account',
  data(){
    return {
      email: 'none',
      isPremium: false,
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
  },
  methods: {
    setPremium() {
      fetch('/api/setPremium',{
        method: 'PATCH'
      })
      .then(response => response.json())
    },
  },
}
</script>

<style scoped>

</style>
