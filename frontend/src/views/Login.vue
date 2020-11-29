<template>
  <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <div class="alert alert-danger" v-for="(error, index) in errors" :key="index">
            {{ error }}
          </div>
          <form v-on:submit.prevent="login()">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" placeholder="Email.." v-model="user.email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" placeholder="Password.." v-model="user.password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      user: {
        email: '',
        password: ''
      },
      errors: null
    }),
    methods: {
      login() {
        this.$store.dispatch('login', this.user)
        .then(response => {
          console.log(response)
          this.$router.push({ name: 'Home' })
        })
        .catch(err => {
          console.log(err)
          this.errors = err.response.data.errors
        })
      }
    }
  }
</script>