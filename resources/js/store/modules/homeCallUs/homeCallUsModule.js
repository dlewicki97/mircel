import axios from "axios";

export default {
    state: {
        homeCallUs: {}
    },
    getters: {
        homeCallUs: state => state.homeCallUs
    },
    mutations: {
        homeCallUs: (state, homeCallUs) => (state.homeCallUs = homeCallUs)
    },
    actions: {
        async homeCallUs({ commit }) {
            await axios
                .get(`/api/home_call_us/get_one/1`)
                .then(res => {
                    commit("homeCallUs", res.data);
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
