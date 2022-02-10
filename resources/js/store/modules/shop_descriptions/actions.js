import axios from 'axios'

export default {
	async shopDescriptions({commit}) {
		await axios.get('/api/shop_descriptions/get_one/1').then(res => commit('shopDescriptions', res.data));
	},
	
}