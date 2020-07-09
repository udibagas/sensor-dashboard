<template>
  <el-dialog
    :close-on-click-modal="false"
    :before-close="closeForm"
    :visible.sync="show"
    title="FORM SENSOR"
  >
    <el-form label-position="left" label-width="150px">
      <el-form-item label="Perusahaan" :class="formError.perusahaan_id ? 'is-error' : ''">
        <el-select v-model="formModel.perusahaan_id" placeholder="Perusahaan" style="width:100%">
          <el-option v-for="p in listPerusahaan" :key="p.id" :value="p.id" :label="p.nama"></el-option>
        </el-select>
        <div
          class="el-form-item__error"
          v-if="formError.perusahaan_id"
        >{{formError.perusahaan_id.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Site" :class="formError.site_id ? 'is-error' : ''">
        <el-select v-model="formModel.site_id" placeholder="Site" style="width:100%">
          <el-option v-for="p in listSite" :key="p.id" :value="p.id" :label="p.nama"></el-option>
        </el-select>
        <div class="el-form-item__error" v-if="formError.site_id">{{formError.site_id.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Kode" :class="formError.kode ? 'is-error' : ''">
        <el-input v-model="formModel.kode" placeholder="Kode"></el-input>
        <div class="el-form-item__error" v-if="formError.kode">{{formError.kode.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Nama" :class="formError.nama ? 'is-error' : ''">
        <el-input v-model="formModel.nama" placeholder="Nama"></el-input>
        <div class="el-form-item__error" v-if="formError.nama">{{formError.nama.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Keterangan" :class="formError.keterangan ? 'is-error' : ''">
        <el-input
          type="textarea"
          :autosize="{ minRows: 2, maxRows: 4}"
          v-model="formModel.keterangan"
          placeholder="Keterangan"
        ></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.keterangan"
        >{{formError.keterangan.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Satuan" :class="formError.satuan ? 'is-error' : ''">
        <el-input v-model="formModel.satuan" placeholder="Satuan"></el-input>
        <div class="el-form-item__error" v-if="formError.satuan">{{formError.satuan.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Nilai Minimum" :class="formError.nilai_minimum ? 'is-error' : ''">
        <el-input
          type="number"
          step="any"
          v-model="formModel.nilai_minimum"
          placeholder="Nilai Minimum"
        ></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.nilai_minimum"
        >{{formError.nilai_minimum.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Nilai Maximum" :class="formError.nilai_maximum ? 'is-error' : ''">
        <el-input
          type="number"
          step="any"
          v-model="formModel.nilai_maximum"
          placeholder="Nilai Maximum"
        ></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.nilai_maximum"
        >{{formError.nilai_maximum.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Nilai Rendah" :class="formError.nilai_rendah ? 'is-error' : ''">
        <el-input
          type="number"
          step="any"
          v-model="formModel.nilai_rendah"
          placeholder="Nilai Rendah"
        ></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.nilai_rendah"
        >{{formError.nilai_rendah.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Nilai Tinggi" :class="formError.nilai_tinggi ? 'is-error' : ''">
        <el-input
          type="number"
          step="any"
          v-model="formModel.nilai_tinggi"
          placeholder="Nilai Tinggi"
        ></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.nilai_tinggi"
        >{{formError.nilai_tinggi.join(', ')}}</div>
      </el-form-item>

      <el-form-item label="Jenis Chart" :class="formError.jenis_chart ? 'is-error' : ''">
        <el-input v-model="formModel.jenis_chart" placeholder="Jenis Chart"></el-input>
        <div
          class="el-form-item__error"
          v-if="formError.jenis_chart"
        >{{formError.jenis_chart.join(', ')}}</div>
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
    ...mapState(['listPerusahaan'])
  },
  data() {
    return {
      formError: {}
    }
  },
  methods: {
    store() {
      this.$axios.post('/api/site', this.formModel).then(r => {
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
      this.$axios.put(`/api/site/${this.data.id}`, this.formModel).then(r => {
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
