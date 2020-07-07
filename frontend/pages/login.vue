<template>
  <el-card class="login-container text-center">
    <h3 class="mt-3">DASHBOARD</h3>
    <br />
    <el-form>
      <el-form-item>
        <el-input v-model="email" placeholder="Email"></el-input>
      </el-form-item>
      <el-form-item>
        <el-input type="password" v-model="password" placeholder="Password"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" style="width:100%" @click="login">LOGIN</el-button>
      </el-form-item>
    </el-form>

    <!-- <small class="text-muted">Nathabuana</small> -->
  </el-card>
</template>

<script>
export default {
  layout: 'login',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  mounted() {
    this.$axios.$get('/sanctum/csrf-cookie');
  },
  methods: {
    async login() {
      try {
        await this.$auth.loginWith('local', { data: {
          email: this.email,
          password: this.password
        } });

        this.$router.push({path: '/'})
      } catch (err) {
        this.$message({
          message: err.response.data.message,
          type: 'error',
          showClose: true
        })
      }
    },
  }
}
</script>

<style lang="css" scoped>
.login-container {
  width: 350px;
}
</style>
