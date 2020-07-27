export const state = () => ({
  listPerusahaan: [],
  filterPerusahaan: [],
  listSite: [],
  filterSite: [],
  listSensor: [],
  filterSensor: [],
  listUser: [],
  filterUser: [],
  listRole: [],
  filterRole: [],
  statusFilter: [
    { value: '0', text: 'Non-Aktif' },
    { value: '1', text: 'Aktif' },
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
  },
  setListRole(state, data) {
    state.listRole = Object.keys(data).map(i => { return { id: parseInt(i), name: data[i] } })
    state.filterRole = state.listRole.map(l => { return { value: l.id, text: l.name } })
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
  async getListRole({ commit }) {
    let { data } = await this.$axios.get('/api/user/getRoleList')
    commit('setListRole', data)
  },
}
