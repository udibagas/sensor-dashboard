export const state = () => ({
  listPerusahaan: []
})

export const mutations = {
  setListPerusahaan(state, data) {
    state.listPerusahaan = data
  }
}

export const actions = {
  async getListPerusahaan({ commit }) {
    let { data } = await this.$axios.get('/api/perusahaan/getList')
    commit('setListPerusahaan', data)
  }
}
