import axios from "axios";

export default {
    state: {
        opinions: []
    },
    getters: {
        opinions: state => state.opinions
    },
    mutations: {
        opinions: (state, opinions) => (state.opinions = opinions)
    },
    actions: {
        async opinions({ commit }) {
            await axios
                .get(`/api/opinions/get_all`)
                .then(res => {
                    commit("opinions", res.data);
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
