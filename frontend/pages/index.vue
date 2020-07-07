<template>
  <el-row :gutter="30">
    <el-col :span="12" v-for="(c,i) in charts" :key="i">
      <highcharts :options="chartOptions"></highcharts>
    </el-col>
  </el-row>
</template>

<script>
import {Chart} from 'highcharts-vue'
export default {
  components: {
    highcharts: Chart
  },
  data() {
    return {
      charts: ['Tinggi Air', 'Suhu', 'Curah Hujan', 'Debit Air', 'Kualitas Air', 'Kadar Lumpur/Endapan'],
      chartOptions: {
        title: {
          show: false
        },
        series: [{
          data: [24,25,25,26,26,26,25,25,26] // sample data
        }]
      }
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
