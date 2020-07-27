<template>
  <el-dialog
    :close-on-click-modal="false"
    :before-close="closeForm"
    :visible.sync="show"
    title="FORM USER"
  >
    <el-form label-position="left" label-width="170px">
      <el-form-item label="Nama" :class="formError.name ? 'is-error' : ''">
        <el-input v-model="formModel.name" placeholder="Nama"></el-input>
        <div class="el-form-item__error" v-if="formError.name">{{formError.name.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Email" :class="formError.email ? 'is-error' : ''">
        <el-input v-model="formModel.email" placeholder="Email"></el-input>
        <div class="el-form-item__error" v-if="formError.email">{{formError.email.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Password" :class="formError.password ? 'is-error' : ''">
        <el-input type="password" v-model="formModel.password" placeholder="Password"></el-input>
        <div class="el-form-item__error" v-if="formError.password">{{formError.password.join(', ')}}</div>
      </el-form-item>

      <el-form-item
        label="Konfirmasi Password"
        :class="formError.password_confirmation ? 'is-error' : ''"
      >
        <el-input
          type="password"
          v-model="formModel.password_confirmation"
          placeholder="Konfirmasi Password"
        ></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.password_confirmation"
        >{{formError.password_confirmation.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Role" :class="formError.role ? 'is-error' : ''">
        <el-select
          v-model="formModel.role"
          placeholder="Role"
          style="width:100%"
          filterable
          clearable
        >
          <el-option v-for="p in listRole" :key="p.id" :value="p.id" :label="p.name"></el-option>
        </el-select>
        <div class="el-form-item__error" v-if="formError.role">{{formError.role.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Perusahaan" :class="formError.perusahaan_id ? 'is-error' : ''">
        <el-select
          v-model="formModel.perusahaan_id"
          placeholder="Perusahaan"
          style="width:100%"
          filterable
          clearable
        >
          <el-option v-for="p in listPerusahaan" :key="p.id" :value="p.id" :label="p.nama"></el-option>
        </el-select>
        <div
          class="el-form-item__error"
          v-if="formError.perusahaan_id"
        >{{formError.perusahaan_id.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Site" :class="formError.site_id ? 'is-error' : ''">
        <el-select
          v-model="formModel.site_id"
          placeholder="Site"
          style="width:100%"
          filterable
          clearable
        >
          <el-option v-for="p in listSite" :key="p.id" :value="p.id" :label="p.nama"></el-option>
        </el-select>
        <div class="el-form-item__error" v-if="formError.site_id">{{formError.site_id.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Status">
        <el-checkbox v-model="formModel.status">Aktif</el-checkbox>
      </el-form-item>
    </el-form>

    <div slot="footer">
      <el-button icon="el-icon-error" type="primary" plain @click="closeForm">BATAL</el-button>
      <el-button
        icon="el-icon-success"
        type="primary"
        @click="() => !!formModel.id ? update() : store()"
      >SIMPAN</el-button>
    </div>
  </el-dialog>
</template>

<script>
import {mapState} from 'vuex'

export default {
  props: ['data', 'show'],
  computed: {
    formModel() {
      return this.data
    },
    ...mapState(['listPerusahaan', 'listSite', 'listRole'])
  },
  data() {
    return {
      formError: {}
    }
  },
  methods: {
    store() {
      this.$axios.post('/api/user', this.formModel).then(r => {
        this.closeForm();
          this.$emit("refresh");
          this.$message({
            message: r.data.message,
            type: "success",
            showClose: true
          });
      }).catch(e => {
        if (e.response.status == 422) {
          this.formError = e.response.data.errors;
        }

        if (e.response.status == 500) {
          this.formError = {};
        }

        this.$message({
          message: e.response.data.message,
          type: "error",
          showClose: true,
          duration: 10000
        });
      })
    },
    update() {
      this.$axios.put(`/api/user/${this.data.id}`, this.formModel).then(r => {
        this.closeForm();
          this.$emit("refresh");
          this.$message({
            message: r.data.message,
            type: "success",
            showClose: true
          });
      }).catch(e => {
        if (e.response.status == 422) {
          this.formError = e.response.data.errors;
        }

        if (e.response.status == 500) {
          this.formError = {};
        }

        this.$message({
          message: e.response.data.message,
          type: "error",
          showClose: true,
          duration: 10000
        });
      })
    },
    closeForm() {
      this.formError = {};
      this.$emit('close');
    }
  }
}
</script>
