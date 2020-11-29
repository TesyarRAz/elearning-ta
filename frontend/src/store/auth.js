import { setHeaderToken, removeHeaderToken } from '../utils/auth'

import axios from 'axios'

export default {
	state: {
		user: null,
		isLoggedIn: false
	},
	mutations: {
		set_user(state, data) {
			state.user = data;
			state.isLoggedIn = data;
		},
		reset_user(state) {
			state.user = null;
			state.isLoggedIn = false;
		}
	},
	getters: {
		isLoggedIn: state => state.isLoggedIn,
		user: state => state.user
	},
	actions: {
		login: ({ dispatch, commit }, data) => new Promise((resolve, reject) => {
			axios.post('/login', data)
			.then(response => {
				const { api_token } = response.data

				localStorage.setItem('token', api_token)
				setHeaderToken(api_token)
				dispatch('getUser')
				resolve(response)
			})
			.catch(err => {
				commit('reset_user')
				localStorage.removeItem('token')
				reject(err)
			})
		}),
		getUser: async ({ commit }) => {
			if (!localStorage.getItem('token')) return

			try	{
				let response = await axios.get('/user')

				commit('set_user', response.data.data)
			} catch (error) {
				commit('reset_user')
				removeHeaderToken()
				localStorage.removeItem('token')
				return error
			}
		}
	},
	modules: {
	}
}