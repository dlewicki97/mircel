import axios from "axios";

export default {
    state: {
        serviceCategories: {},
    },
    getters: {
        serviceCategories: state => state.serviceCategories
    },
    mutations: {
        serviceCategories: (state, serviceCategories) => state.serviceCategories = serviceCategories
    },
    actions: {
        async serviceCategories({ commit }) {
            await axios
                .get(`/api/service_categories/get_all`)
                .then(res => {
                    commit("serviceCategories", res.data);
                })
                .catch(err => {
                    console.log(err);
                    commit('setSnackbar', 'Przepraszamy, nie udało się załadować danych usługi...');
                });
        }
    }
}