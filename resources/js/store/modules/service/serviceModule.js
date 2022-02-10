import axios from "axios";

export default {
    state: {
        service: {},
    },
    getters: {
        service: state => state.service
    },
    mutations: {
        service: (state, service) => state.service = service
    },
    actions: {
        async service({ commit }, id) {
            await axios
                .get(`/api/services/get_one/${id}`)
                .then(res => {
                    commit("service", res.data);
                })
                .catch(err => {
                    console.log(err);
                    commit('setSnackbar', 'Przepraszamy, nie udało się załadować danych usługi...');
                });
        }
    }
}