import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import pl from "vuetify/src/locale/pl.ts";

Vue.use(Vuetify);

const opts = {
    icons: {
        iconfont: "mdi"
    },
    theme: {
        themes: {
            light: {
                primary: "#6C5EA2"
            }
        }
    },
    options: {
        customProperties: true
    },
    lang: {
        locales: { pl },
        current: "pl"
    }
};

export default new Vuetify(opts);
