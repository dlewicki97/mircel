import axios from "axios";

export default {
    state: {
        attributesDesc: {}
    },
    getters: {
        attributesDesc: state => state.attributesDesc
    },
    mutations: {
        attributesDesc: (state, attributesDesc) =>
            (state.attributesDesc = attributesDesc)
    },
    actions: {
        async attributesDesc({ commit }) {
            await axios
                .get(`/api/attributes_desc/get_one/1`)
                .then(res => {
                    commit("attributesDesc", res.data);
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
