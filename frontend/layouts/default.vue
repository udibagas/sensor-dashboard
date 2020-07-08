<template>
  <el-container style="height:calc(100vh)">
    <el-aside :width="collapse ? 'auto' : '200px'" style="background-color:#193495;color:#fff;">
      <el-menu
        router
        :collapse="collapse"
        background-color="#193495"
        text-color="#ccc"
        active-text-color="#fff"
      >
        <el-menu-item v-for="(m, i) in menus" :index="m.path" :key="i">
          <i :class="m.icon"></i>
          <span slot="title">{{m.label}}</span>
        </el-menu-item>
      </el-menu>
    </el-aside>
    <el-container>
      <el-header class="d-flex">
        <div class="flex-grow-1">
          <i
            :class="collapse ? 'el-icon-s-unfold' : 'el-icon-s-fold'"
            @click="collapse = !collapse"
            style="font-size:22px;margin:20px 20px 0 0;cursor:pointer;"
          ></i>
          <span class="brand">DASHBOARD SENSOR</span>
        </div>
        <div>
          <el-dropdown trigger="click">
            <el-avatar :size="35" style="vertical-align:middle;margin:0px 10px 0 20px"></el-avatar>

            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item command="profile">
                <i class="el-icon-user"></i> Profile
              </el-dropdown-item>
              <el-dropdown-item command="logout">
                <i class="el-icon-switch-button"></i>
                Logout
              </el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          {{$auth.user.name}}
        </div>
      </el-header>
      <el-main>
        <Nuxt />
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
export default {
  middleware: 'auth',
  data() {
    return {
      collapse: false,
      menus: [],
    }
  },
  methods: {
    getNavigation() {
      this.$axios.get('/api/navigation').then(r => {
        this.menus = r.data
      })
    }
  },
  mounted() {
    this.getNavigation()
    this.$store.dispatch('getListPerusahaan');
  }
}
</script>

<style lang="css" scoped>
.brand {
  font-size: 22px;
}

.el-aside {
  border-right: 1px solid #193495;
}

.el-menu {
  border-color: #193495;
}

.el-header {
  border-bottom: 1px solid #ddd;
  line-height: 60px;
}
</style>
