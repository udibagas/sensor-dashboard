export const state = () => ({
  listPerusahaan: [],
  filterPerusahaan: [],
  listSite: [],
  filterSite: [],
  listSensor: [],
  filterSensor: [],
  listUser: [],
  filterUser: [],
  statusFilter: [
    { value: '0', text: 'Aktif' },
    { value: '1', text: 'Non-Aktif' },
  ]
})

export const mutations = {
  setListPerusahaan(state, data) {
    state.listPerusahaan = data
    state.filterPerusahaan = data.map(l => { return { value: l.id, text: l.nama } })
  },
  setListSite(state, data) {
    state.listSite = data
    state.filterSite = data.map(l => { return { value: l.id, text: l.nama } })
  },
  setListSensor(state, data) {
    state.listSensor = data
    state.filterSensor = data.map(l => { return { value: l.id, text: l.nama } })
  },
  setListUser(state, data) {
    state.listUser = data
    state.filterUser = data.map(l => { return { value: l.id, text: l.name } })
  }
}

export const actions = {
  async getListPerusahaan({ commit }) {
    let { data } = await this.$axios.get('/api/perusahaan/getList')
    commit('setListPerusahaan', data)
  },
  async getListSite({ commit }) {
    let { data } = await this.$axios.get('/api/site/getList')
    commit('setListSite', data)
  },
  async getListSensor({ commit }) {
    let { data } = await this.$axios.get('/api/sensor/getList')
    commit('setListSensor', data)
  },
  async getListUser({ commit }) {
    let { data } = await this.$axios.get('/api/user/getList')
    commit('setListUser', data)
  },
}
