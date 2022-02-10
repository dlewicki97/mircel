import axios from "axios";
import router from "@/router/routes.js";

export default {
    state: {
        about: {}
    },
    getters: {
        about: state => state.about
    },
    mutations: {
        about: (state, about) => (state.about = about)
    },
    actions: {
        async about({ commit }) {
            await router;
            await axios
                .get(`/api/about/get_one/1`)
                .then(res => {
                    commit("about", res.data);
                })
                .catch(err => {
                    console.log(err);
                    commit(
                        "setSnackbar",
                        "Przepraszamy, nie udało się załadować sekcji pod sliderem..."
                    );
                });
        }
    }
};
