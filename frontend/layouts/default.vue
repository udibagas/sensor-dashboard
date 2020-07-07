<template>
  <el-container style="height:calc(100vh)">
    <el-aside :width="collapse ? 'auto' : '250px'" style="background-color:#193495;color:#fff;">
      <el-menu
        default-active="2"
        :collapse="collapse"
        background-color="#193495"
        text-color="#ccc"
        active-text-color="#fff"
      >
        <el-submenu index="1">
          <template slot="title">
            <i class="el-icon-location"></i>
            <span>Navigator One</span>
          </template>
          <el-menu-item-group title="Group One">
            <el-menu-item index="1-1">item one</el-menu-item>
            <el-menu-item index="1-2">item one</el-menu-item>
          </el-menu-item-group>
          <el-menu-item-group title="Group Two">
            <el-menu-item index="1-3">item three</el-menu-item>
          </el-menu-item-group>
          <el-submenu index="1-4">
            <template slot="title">item four</template>
            <el-menu-item index="1-4-1">item one</el-menu-item>
          </el-submenu>
        </el-submenu>
        <el-menu-item index="2">
          <i class="el-icon-menu"></i>
          <span>Navigator Two</span>
        </el-menu-item>
        <el-menu-item index="4">
          <i class="el-icon-setting"></i>
          <span>Navigator Four</span>
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
      collapse: false
    }
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
