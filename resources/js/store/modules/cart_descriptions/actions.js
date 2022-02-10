import axios from 'axios'

export default {
	async cartDescriptions({commit}) {
		await axios.get('/api/cart_descriptions/get_one/1').then(res => commit('cartDescriptions', res.data));
	},
	
}