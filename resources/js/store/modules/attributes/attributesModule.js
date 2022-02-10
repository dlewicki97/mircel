import axios from "axios";

export default {
    state: {
        attributes: []
    },
    getters: {
        attributes: state => state.attributes
    },
    mutations: {
        attributes: (state, attributes) => (state.attributes = attributes)
    },
    actions: {
        async attributes({ commit }) {
            await axios
                .get(`/api/attributes/get_all`)
                .then(res => {
                    commit("attributes", res.data);
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
