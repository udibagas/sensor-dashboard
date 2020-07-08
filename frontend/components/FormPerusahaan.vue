<template>
  <el-dialog
    :close-on-click-modal="false"
    :before-close="closeForm"
    :visible.sync="show"
    title="FORM PERUSAHAAN"
  >
    <el-form label-position="left" label-width="150px">
      <el-form-item label="Kode" :class="formError.kode ? 'is-error' : ''">
        <el-input v-model="formModel.kode" placeholder="Kode"></el-input>
        <div class="el-form-item__error" v-if="formError.kode">{{formError.kode.join(', ')}}</div>
      </el-form-item>
      <el-form-item label="Nama" :class="formError.nama ? 'is-error' : ''">
        <el-input v-model="formModel.nama" placeholder="Nama"></el-input>
        <div class="el-form-item__error" v-if="formError.nama">{{formError.nama.join(', ')}}</div>
      </el-form-item>
      <el-form-item label="Alamat" :class="formError.alamat ? 'is-error' : ''">
        <el-input
          type="textarea"
          :autosize="{ minRows: 2, maxRows: 4}"
          v-model="formModel.alamat"
          placeholder="Alamat"
        ></el-input>
        <div class="el-form-item__error" v-if="formError.alamat">{{formError.alamat.join(', ')}}</div>
      </el-form-item>
      <el-form-item label="Telp" :class="formError.telp ? 'is-error' : ''">
        <el-input v-model="formModel.telp" placeholder="Telp"></el-input>
        <div class="el-form-item__error" v-if="formError.telp">{{formError.telp.join(', ')}}</div>
      </el-form-item>
      <el-form-item label="Fax" :class="formError.fax ? 'is-error' : ''">
        <el-input v-model="formModel.fax" placeholder="Fax"></el-input>
        <div class="el-form-item__error" v-if="formError.fax">{{formError.fax.join(', ')}}</div>
      </el-form-item>
      <el-form-item label="Email" :class="formError.email ? 'is-error' : ''">
        <el-input v-model="formModel.email" placeholder="Email"></el-input>
        <div class="el-form-item__error" v-if="formError.email">{{formError.email.join(', ')}}</div>
      </el-form-item>
      <el-form-item label="Website" :class="formError.website ? 'is-error' : ''">
        <el-input v-model="formModel.website" placeholder="Website"></el-input>
        <div class="el-form-item__error" v-if="formError.website">{{formError.website.join(', ')}}</div>
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
export default {
  props: ['data', 'show'],
  computed: {
    formModel() {
      return this.data
    }
  },
  data() {
    return {
      formError: {}
    }
  },
  methods: {
    store() {
      this.$axios.post('/api/perusahaan', this.formModel).then(r => {
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
      this.$axios.put(`/api/perusahaan/${this.data.id}`, this.formModel).then(r => {
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
