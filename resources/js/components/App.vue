<template>
    <v-app class="app">
        <header>
            <HeaderComponent
                :openLogin="openLogin"
                v-if="!isPathAdmin"
                class="header"
            />
            <AdminHeader v-else-if="$route.name != 'AdminLogin'" />
        </header>
        <main>
            <Banner v-if="$route.name != 'Main' && !isPathAdmin" />
            <router-view
                @metaTitle="title = $event"
                :class="{ 'admin-body': isPathAdmin }"
            ></router-view>
        </main>

        <AdminSnackbar />

        <footer>
            <FooterComponent v-if="!isPathAdmin" />
        </footer>

        <Loader v-if="loading" />
        <Cookies v-if="!isPathAdmin" />
    </v-app>
</template>

<script>
import HeaderComponent from "./layouts/Header";
import FooterComponent from "./layouts/Footer";
import Banner from "./layouts/Banner";
import AdminHeader from "./layouts/AdminHeader";
import AdminSnackbar from "./snackbar/AdminSnackbar";
import Loader from "./loader/Loader";
import Cookies from "@/components/cookies/Cookies";
import "@/font/JosefinSans/stylesheet.css";

function recaptcha() {
    let badge = document.getElementsByClassName("grecaptcha-badge")[0];
    if (!badge) return;
    if (window.location.href.split("/").includes("admin-panel"))
        badge.classList.add("d-none");
    else badge.classList.remove("d-none");
}

window.addEventListener("load", function() {
    recaptcha();
});

export default {
    metaInfo() {
        return {
            title: this.title,
            titleTemplate: "%s - " + this.settings.company
        };
    },
    components: {
        HeaderComponent,
        FooterComponent,
        AdminHeader,
        AdminSnackbar,
        Loader,
        Cookies,
        Banner
    },
    data() {
        return {
            title: "",
            openLogin: false
        };
    },
    watch: {
        currentSubpage: {
            deep: true,
            handler() {
                if (this.currentSubpage?.id)
                    this.title = this.currentSubpage.title;
            }
        },
        "$route.path"() {
            recaptcha();
            this.checkSubpageEntry();
            this.setCurrentSubpage();
        },
        subpages() {
            if (this.subpages.length > 0) this.checkSubpageEntry();
        },
        "$store.getters.snackbarAlerts.id"() {
            if (this.$store.getters.snackbarAlerts.id) {
                if (this.$route.query.aktywacja == "1") {
                    this.$store.commit(
                        "setSnackbar",
                        this.$store.getters.snackbarAlerts
                            .activated_account_success
                    );
                }
            }
        }
    },
    computed: {
        isPathAdmin() {
            const pathSegments = this.$route.path.split("/");
            return pathSegments[1] == "admin-panel" ? true : false;
        },
        loading() {
            return this.$store.getters.loading;
        },
        subpages() {
            return this.$store.getters.subpages;
        },
        currentSubpage() {
            return this.$store.getters.currentSubpage;
        },
        settings() {
            return this.$store.getters.settings;
        }
    },
    methods: {
        openLoginEvent() {
            this.openLogin = true;
            setTimeout(() => (this.openLogin = false), 20);
        },
        checkSubpageEntry() {
            for (let subpage of this.subpages) {
                if (subpage.page == "/" + this.$route.path.split("/")[1]) {
                    if (!subpage.active && subpage.page != "/koszyk")
                        this.$router.push("/");
                }
            }
        },
        setMetaTitle() {
            if (this.$route.path.split("/").includes("admin-panel"))
                this.title = "Panel Administracyjny";
            else
                this.title = this.currentSubpage
                    ? this.currentSubpage.title
                    : "";
        },

        autoLogin() {
            if (localStorage.getItem("fbLogin")) {
                this.$store.dispatch("fbLogin");
            }

            if (localStorage.getItem("authLogin")) {
                this.$store.dispatch("authAutoLogin");
            }
        },
        setCart() {
            if (localStorage.getItem("cart") != null) {
                this.$store.commit(
                    "cart",
                    JSON.parse(localStorage.getItem("cart"))
                );
            }
        },
        setCurrentSubpage() {
            this.$store.commit(
                "currentSubpage",
                this.subpages.find(
                    subpage =>
                        subpage.page == "/" + this.$route.path.split("/")[1]
                )
            );
        }
    },
    async created() {
        this.autoLogin();
        this.setCart();
        this.setMetaTitle();
        this.$store.dispatch("settings");
        this.$store.dispatch("contact");
        this.$store.dispatch("snackbarAlerts");
        await this.$store.dispatch("fetchSubpages");
        this.setCurrentSubpage();

        if (window.location.hash && window.location.hash == "#_=_") {
            window.location.href = window.location.origin;
        }
    }
};
</script>

<style lang="scss">
* {
    font-family: "Josefin Sans" !important;
}
*::selection {
    color: white;
    background-color: var(--first-color);
}
body {
    overflow-x: hidden;
}
b {
    color: var(--first-color);
}
:root {
    --global-padding-x-desktop: 5rem;
    --global-padding-x-mobile: 1.5rem;
    --first-color: rgb(108, 94, 162);
    --first-color-r: 108;
    --first-color-g: 94;
    --first-color-b: 162;
    --global-border-radius: 12px;
}

.section-title {
    font-weight: 700;
    font-size: 2rem;
    color: #333333;
    margin-bottom: 0;
    @media (max-width: 300px) {
        font-size: 1.8rem;
        text-align: center;
    }
    span {
        color: #8372c3;
    }
}
.section-content {
    .bolt {
        height: 75px !important;
        @media (max-width: 400px) {
            padding-right: 0 !important;
        }
    }
}

.header {
    border-radius: unset !important;
}

footer {
    position: relative;
}

::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background-color: lightgray;
}

::-webkit-scrollbar-thumb {
    background-color: var(--first-color);
    border-radius: 12px;
}

.app,
.ql-container {
    font-family: "Candara";
    font-weight: 300;
}

.ql-editing {
    left: unset !important;
}

.first-color {
    color: var(--first-color);
}

.first-bgc {
    background-color: var(--first-color) !important;
}

a:hover {
    text-decoration: none !important;
}

blockquote {
    border-left: 4px solid #ccc;
    margin-bottom: 5px;
    margin-top: 5px;
    padding-left: 16px;
}

.bg {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
}

.button {
    padding: 0.9rem 1.5rem;
    font-size: 0.9rem;
    font-weight: 400;
    border-radius: var(--global-border-radius);
    transition: 0.2s background-color;
    text-transform: uppercase;
}
.first-button {
    background-color: #8275b3;
    color: white;
    &:hover {
        background-color: var(--first-color);
    }
}
.second-button {
    $bgc: white;
    background-color: $bgc;
    color: black;
    &:hover {
        background-color: #f5f5f5;
    }
}
</style>
