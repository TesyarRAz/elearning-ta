import { createStore } from 'vuex'

import auth from './auth'

import axios from 'axios'

export default createStore({
	state: {

	},
	mutations: {

	},
	actions: {
		getPelajaran: async(_, data) => await axios.get('/pelajaran', {
			params: {
				data
			}
		}).then(response => response.data),
		getModul: async(_, data) => await axios.get('/modul', {
			params: {
				data
			}
		}).then(response => response.data),
		getModulById: async(_, data) => await axios.get('/modul/' + data, {
			params: {
				data
			}
		}).then(response => response.data)
	},
	modules: {
		auth
	}
})
