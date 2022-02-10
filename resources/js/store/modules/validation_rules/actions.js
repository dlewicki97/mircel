import axios from 'axios'

export default {
	validationRules: async ({commit}) => await axios.get('api/validation_rules/get_one/1').then(res => commit('validationRules', res.data)),
}