import axios from "axios";

export default {
    state: {
        homeServices: []
    },
    getters: {
        homeServices: state => state.homeServices
    },
    mutations: {
        homeServices: (state, homeServices) =>
            (state.homeServices = homeServices)
    },
    actions: {
        async homeServices({ commit }) {
            await axios
                .get(`/api/services/get_where?home_page=1`)
                .then(res => {
                    commit("homeServices", res.data);
                })
                .catch(err => {
                    console.log(err);
                    commit(
                        "setSnackbar",
                        "Przepraszamy, nie udało się załadować danych usługi..."
                    );
                });
        }
    }
};
