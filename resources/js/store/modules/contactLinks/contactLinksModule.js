import axios from "axios";

export default {
    state: {
        contactLinks: []
    },
    getters: {
        contactLinks: state => state.contactLinks
    },
    mutations: {
        contactLinks: (state, contactLinks) => (state.contactLinks = contactLinks)
    },
    actions: {
        async contactLinks({ commit }) {
            await axios
                .get(`/api/contact_links/get_all`)
                .then(res => {
                    commit("contactLinks", res.data);
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
