import axios from 'axios'

export default {
	async fetchSomeUsers({commit}) {
		await axios.get('/api/users/get_where?type=Admin&type=Klient&type=Zawodnik').then(res => {
			commit('users', res.data);
		})
	},
	async fetchAllUsers({commit}) {
		await axios.get('/api/users/get_all').then(res => {
			commit('users', res.data);
		})
	},
	async fetchUsersByID({commit}, users) {
		let request = '';
		for(let user of users) request += `&id[]=${user}`;
		await axios.get(`/api/users/get_commentators?${request}`).then(res => commit('users', res.data));
	}
}