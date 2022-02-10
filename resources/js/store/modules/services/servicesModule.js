import axios from "axios";

export default {
    state: {
        services: {},
    },
    getters: {
        services: state => state.services
    },
    mutations: {
        services: (state, services) => state.services = services
    },
    actions: {
        async services({ commit }) {
            await axios
                .get(`/api/services/get_all`)
                .then(res => {
                    commit("services", res.data);
                })
                .catch(err => {
                    console.log(err);
                    commit('setSnackbar', 'Przepraszamy, nie udało się załadować danych usługi...');
                });
        }
    }
}