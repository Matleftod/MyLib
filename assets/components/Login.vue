<template>
  <div>
    <form method="post" v-on:submit.prevent="sendLogin" class="form-group">
        <label for="inputEmail">Email:</label>
        <input type="email" id="inputEmail" name="email" v-model="email" placeholder="E-mail" required autofocus>

        <label for="inputPassword">Password:</label>
        <input type="password" id="inputPassword" name="password" v-model="password" placeholder="Password" required>

        <input type="hidden" name="_target_path" value="/default">

        <input type="hidden" name="_csrf_token" value="csrf_token">

        <button type="submit">login</button>
    </form>

    <div v-if="isError === true">
      <div class="alert alert-danger" role="alert">
        {{ errorMessage }}
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Login',
  props: ['csrf_token', 'last_email'],
  data(){
    return{
      email: '',
      password: '',
      isError: false,
      errorMessage: '',
    }
  },
  created(){
    if(this.$props.last_email !== 'undefined'){
      this.email = this.$props.last_email;
    }

  },
  methods:{
    sendLogin(){
      console.log("send login form");
      fetch('/api/login', {
        method: 'POST',
        headers: {'Content-Type': 'application.json'},
        body: JSON.stringify({
          'email' : this.email,
          'password' : this.password,
          '_csrf_token' : this.$props.csrf_token
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data === 'authenticated'){
          this.$router.push('/');
        }else {
          this.isError = true;
          this.errorMessage = data;
        }
      })
    }
  }
}
</script>
