<template>
  <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Register
        </div>
        <div class="card-body">
          <form v-on:submit.prevent="register()">
            <div class="form-group" v-if="step == 0">
              <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" class="form-control" placeholder="Name.." v-model="user.name">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" class="form-control" placeholder="Alamat..." v-model="user.alamat"></textarea>
              </div>
              <div class="form-group">
                <label>Role</label>
                <div class="form-group">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="siswa" id="siswa" name="role" v-model="user.role">
                    <label class="form-check-label" for="siswa">
                      Siswa
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="guru" id="guru" name="role" v-model="user.role">
                    <label class="form-check-label" for="guru">
                      Guru
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group clearfix">
                <button type="button" class="btn btn-primary float-right" v-on:click="nextStep()">Next</button>
              </div>
            </div>
            <div class="form-group" v-if="step == 1">
              <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" class="form-control" placeholder="Email.." v-model="user.email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" placeholder="Password.." v-model="user.password">
              </div>
              <div class="form-group clearfix">
                <button type="button" class="btn btn-primary float-left" v-on:click="backStep()">Back</button>
                <button type="submit" class="btn btn-primary float-right">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      step: 0,
      user: {
        name: '',
        role: '',
        alamat: '',
        email: '',
        password: ''
      }
    }),
    methods: {
      nextStep() {
        this.step = 1;
      },
      backStep() {
        this.step = 0;
      },
      register() {
        
      }
    }
  }
</script>