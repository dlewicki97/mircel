import axios from "axios";

export default {
    state: {
        slider: []
    },
    mutations: {
        slider: (state, slider) => (state.slider = slider)
    },
    getters: {
        slider: state => state.slider
    },
    actions: {
        slider: async ({ commit }) => {
            axios
                .get(`/api/slider/get_all`)
                .then(res => {
                    commit("loading", false);
                    commit("slider", res.data);
                })
                .catch(err => {
                    commit("loading", false);
                    console.log(err);
                });
        }
    }
};
