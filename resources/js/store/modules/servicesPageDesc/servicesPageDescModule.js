import axios from "axios";

export default {
    state: {
        servicesPageDesc: {}
    },
    getters: {
        servicesPageDesc: state => state.servicesPageDesc
    },
    mutations: {
        servicesPageDesc: (state, servicesPageDesc) =>
            (state.servicesPageDesc = servicesPageDesc)
    },
    actions: {
        async servicesPageDesc({ commit }) {
            await axios
                .get(`/api/services_page_desc/get_one/1`)
                .then(res => {
                    commit("servicesPageDesc", res.data);
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
