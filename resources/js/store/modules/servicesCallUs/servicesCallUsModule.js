import axios from "axios";

export default {
    state: {
        servicesCallUs: {}
    },
    getters: {
        servicesCallUs: state => state.servicesCallUs
    },
    mutations: {
        servicesCallUs: (state, servicesCallUs) =>
            (state.servicesCallUs = servicesCallUs)
    },
    actions: {
        async servicesCallUs({ commit }) {
            await axios
                .get(`/api/services_call_us/get_one/1`)
                .then(res => {
                    commit("servicesCallUs", res.data);
                })
                .catch(err => {
                    console.log(err);
                    commit(
                        "setSnackbar",
                        "Przepraszamy, nie udało się załadować danych..."
                    );
                });
        }
    }
};
