import axios from "axios";
import parseJwt from "../../../helpers/auth/tokenDecoder.js";
import router from "@/router/routes.js";

export default {
    async fbLogin({ dispatch, commit }) {
        await axios
            .get("api/facebook/login/get_token")
            .then(res => {
                if (res.data == "") dispatch("logout");
                localStorage.setItem("token", res.data.token);
                localStorage.setItem("user", JSON.stringify(res.data.data));
                commit("setToken", res.data.token);
                commit("setUser", res.data.data);
            })
            .catch(err => console.log(err));
    },
    async authLogin({ commit, getters }, credentials) {
        await router;
        await axios
            .post("api/auth/login", credentials)
            .then(res => {
                if (res.data.error) {
                    commit("setSnackbar", res.data.error.message);
                } else {
                    localStorage.setItem("token", res.data.token);
                    localStorage.setItem("user", JSON.stringify(res.data.data));
                    localStorage.setItem("authLogin", true);
                    commit("setToken", res.data.token);
                    commit("setUser", res.data.data);
                    commit("setSnackbar", getters.snackbarAlerts.login_success);
                    router.push({ name: "AdminHome" });
                }
            })
            .catch(err => console.log(err));
    },
    async authAutoLogin({ commit }) {
        let userId = parseJwt(localStorage.getItem("token")).sub;
        await axios.post("api/auth/auto_login/", { id: userId });
        await axios
            .get("api/users/get_one/" + userId)
            .then(res => {
                commit("setUser", res.data);
                commit("setToken", localStorage.getItem("token"));
            })
            .catch(err => console.log(err));
    },
    async register({ commit, getters }, credentials) {
        commit("loading", true);
        await axios
            .post("api/auth/register", credentials)
            .then(res => {
                commit("loading", false);
                if (res.data.error) {
                    commit("setSnackbar", res.data.error.message);
                } else {
                    commit("setToken", res.data.token);
                    commit("setUser", res.data.data);
                    commit(
                        "setSnackbar",
                        getters.snackbarAlerts.register_success
                    );
                }
            })
            .catch(err => {
                console.log(err);
                commit("loading", false);
            });
    },
    logout({ commit }) {
        console.log("logout");
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        localStorage.removeItem("fbLogin");
        localStorage.removeItem("authLogin");
        commit("setUser", {});
        commit("setToken", "");
    }
};
