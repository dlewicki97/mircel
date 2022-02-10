import axios from "axios";

export default {
    state: {
        homeServiceDesc: {}
    },
    getters: {
        homeServiceDesc: state => state.homeServiceDesc
    },
    mutations: {
        homeServiceDesc: (state, homeServiceDesc) =>
            (state.homeServiceDesc = homeServiceDesc)
    },
    actions: {
        async homeServiceDesc({ commit }) {
            await axios
                .get(`/api/home_service_desc/get_one/1`)
                .then(res => {
                    commit("homeServiceDesc", res.data);
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
