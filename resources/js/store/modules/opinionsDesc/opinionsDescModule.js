import axios from "axios";

export default {
    state: {
        opinionsDesc: {}
    },
    getters: {
        opinionsDesc: state => state.opinionsDesc
    },
    mutations: {
        opinionsDesc: (state, opinionsDesc) =>
            (state.opinionsDesc = opinionsDesc)
    },
    actions: {
        async opinionsDesc({ commit }) {
            await axios
                .get(`/api/opinions_desc/get_one/1`)
                .then(res => {
                    commit("opinionsDesc", res.data);
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
