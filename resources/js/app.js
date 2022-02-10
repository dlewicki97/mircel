import Vue from "vue";
import router from "@/router/routes";
import vuetify from "../plugins/vuetify";
import axios from "axios";
import VueAxios from "vue-axios";
import store from "./store/store.js";
import Vuelidate from "vuelidate";
import "owl.carousel/dist/assets/owl.carousel.css";
import "owl.carousel";
import VueMeta from "vue-meta";
import VueLazyload from "vue-lazyload";

Vue.component("app", require("./components/App.vue").default);
Vue.use(Vuelidate);
Vue.use(VueAxios, axios);
Vue.use(VueMeta, {
    refreshOnceOnNavigation: true
});
Vue.use(VueLazyload);

Vue.prototype.$vueMeta = VueMeta;

const ignoreWarnMessage =
    "The .native modifier for v-on is only valid on components but it was used on <div>.";
Vue.config.warnHandler = function(msg, vm, trace) {
    if (msg === ignoreWarnMessage) {
        msg = null;
        vm = null;
        trace = null;
    }
};

Vue.axios.defaults.baseURL = window.location.origin;
Vue.axios.interceptors.request.use(
    config => {
        const token = localStorage.getItem("token");
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        config.headers["Access-Control-Allow-Origin"] = "*";

        return config;
    },
    error => Promise.reject(error)
);

export const app = new Vue({
    el: "#app",
    router,
    vuetify,
    store
});
