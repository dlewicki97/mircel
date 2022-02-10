import axios from "axios";

export default {
    state: {
        homeSolarSystemDesc: {}
    },
    getters: {
        homeSolarSystemDesc: state => state.homeSolarSystemDesc
    },
    mutations: {
        homeSolarSystemDesc: (state, homeSolarSystemDesc) =>
            (state.homeSolarSystemDesc = homeSolarSystemDesc)
    },
    actions: {
        async homeSolarSystemDesc({ commit }) {
            await axios
                .get(`/api/home_solar_system_desc/get_one/1`)
                .then(res => {
                    commit("homeSolarSystemDesc", res.data);
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
