import axios from 'axios'

export default {
	snackbarAlerts: async ({commit}) => await axios.get('api/snackbar_alerts/get_one/1').then(res => commit('snackbarAlerts', res.data)),
}