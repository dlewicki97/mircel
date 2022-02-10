import axios from "axios";

export default {
    state: {
        example: []
    },
    getters: {
        example: state => state.example
    },
    mutations: {
        example: (state, example) => (state.example = example)
    },
    actions: {
        async example({ commit }) {
            await axios
                .get(`/api/table_name/get_all`)
                .then(res => {
                    commit("example", res.data);
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
