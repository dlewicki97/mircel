<template>
    <v-navigation-drawer
        class="admin-header admin-drawer"
        v-model="drawer"
        color="primary"
        left
        :permanent="true"
        expand-on-hover
        app
        dark
    >
        <v-list dense nav class="py-0">
            <v-list-item two-line :class="'px-0'">
                <v-list-item-avatar>
                    <img class="avatar" v-lazy="placeholder" />
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>Panel Administracyjny</v-list-item-title>
                    <router-link to="/">
                        <v-list-item-subtitle>{{
                            settings.company
                        }}</v-list-item-subtitle>
                    </router-link>
                    <v-btn
                        class="mt-5"
                        x-small
                        color="gray"
                        style="border-radius: unset !important"
                        icon
                        @click="logout"
                    >
                        <v-icon left>mdi-logout</v-icon>
                        <span>Wyloguj</span>
                    </v-btn>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>
            <v-list-item-group v-model="selectedItem">
                <v-list-item
                    v-for="(item, i) in items"
                    :key="item.title"
                    @load="
                        item.path.split('/')[1] == $route.path.split('/')[1]
                            ? (selectedItem = i)
                            : true
                    "
                    link
                    active-class="nav-link"
                    @click="
                        $route.path == item.path
                            ? true
                            : $router.push(item.path)
                    "
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import avatar from "../../helpers/photo/avatar.js";

export default {
    data() {
        return {
            avatar,
            drawer: true,

            items: [
                {
                    title: "Strona główna",
                    icon: "mdi-view-dashboard",
                    path: "/admin-panel/main"
                },

                {
                    title: "Usługi",
                    icon: "mdi-tag-multiple",
                    path: "/admin-panel/services"
                },

                {
                    title: "Realizacje",
                    icon: "mdi-image-multiple",
                    path: "/admin-panel/realizations"
                },
                {
                    title: "Fotowoltaika",
                    icon: "mdi-solar-panel",
                    path: "/admin-panel/solar_system"
                },
                {
                    title: "Kontakt",
                    icon: "mdi-phone",
                    path: "/admin-panel/contact"
                },

                {
                    title: "Pozostałe opisy",
                    icon: "mdi-table-of-contents",
                    path: "/admin-panel/descriptions"
                },
                {
                    title: "Skrzynka pocztowa",
                    icon: "mdi-mailbox",
                    path: "/admin-panel/mails"
                },

                {
                    title: "Podstrony",
                    icon: "mdi-folder-multiple",
                    path: "/admin-panel/subpages"
                },
                {
                    title: "Ustawienia",
                    icon: "mdi-cog",
                    path: "/admin-panel/settings"
                }
            ]
        };
    },
    created() {
        this.$store.dispatch("fetchSomeUsers");
    },
    computed: {
        placeholder() {
            return window.location.origin + "/storage/img/avatar/avatar.png";
        },
        settings() {
            return this.$store.getters.settings;
        },
        selectedItem() {
            let selectedItem = undefined;

            for (let item of this.items) {
                if (item.path.split("/")[2] == this.$route.path.split("/")[2]) {
                    selectedItem = this.items.indexOf(item);
                }
            }

            if (this.$route.path.split("/")[2] == "price_list")
                selectedItem = this.items.indexOf(
                    this.items.find(
                        item =>
                            item.path == "/admin-panel/price_list_categories"
                    )
                );

            return selectedItem;
        }
    },
    methods: {
        logout() {
            this.$store.dispatch("logout");
            this.$router.push({ name: "AdminLogin" });
        }
    }
};
</script>
<style lang="scss" scoped>
.avatar {
    object-fit: cover;
}

.admin-drawer {
    min-width: 66px;
}
</style>
<style>
* {
    font-family: "Candara" !important;
}

.nav-drawer {
    background-color: blue;
}

.ql-editor strong {
    font-weight: bold;
}

.ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke,
.ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke-miter,
.ql-snow .ql-toolbar .ql-picker-item:hover .ql-stroke,
.ql-snow .ql-toolbar .ql-picker-item:hover .ql-stroke-miter,
.ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke,
.ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke-miter,
.ql-snow .ql-toolbar .ql-picker-label:hover .ql-stroke,
.ql-snow .ql-toolbar .ql-picker-label:hover .ql-stroke-miter,
.ql-snow .ql-toolbar button.ql-active .ql-stroke,
.ql-snow .ql-toolbar button.ql-active .ql-stroke-miter,
.ql-snow .ql-toolbar button:focus .ql-stroke,
.ql-snow .ql-toolbar button:focus .ql-stroke-miter,
.ql-snow .ql-toolbar button:hover .ql-stroke,
.ql-snow .ql-toolbar button:hover .ql-stroke-miter,
.ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke,
.ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke-miter,
.ql-snow.ql-toolbar .ql-picker-item:hover .ql-stroke,
.ql-snow.ql-toolbar .ql-picker-item:hover .ql-stroke-miter,
.ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke,
.ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke-miter,
.ql-snow.ql-toolbar .ql-picker-label:hover .ql-stroke,
.ql-snow.ql-toolbar .ql-picker-label:hover .ql-stroke-miter,
.ql-snow.ql-toolbar button.ql-active .ql-stroke,
.ql-snow.ql-toolbar button.ql-active .ql-stroke-miter,
.ql-snow.ql-toolbar button:focus .ql-stroke,
.ql-snow.ql-toolbar button:focus .ql-stroke-miter,
.ql-snow.ql-toolbar button:hover .ql-stroke,
.ql-snow.ql-toolbar button:hover .ql-stroke-miter {
    stroke: var(--first-color) !important;
}

.ql-snow .ql-toolbar .ql-picker-item.ql-selected,
.ql-snow .ql-toolbar .ql-picker-item:hover,
.ql-snow .ql-toolbar .ql-picker-label.ql-active,
.ql-snow .ql-toolbar .ql-picker-label:hover,
.ql-snow .ql-toolbar button.ql-active,
.ql-snow .ql-toolbar button:focus,
.ql-snow .ql-toolbar button:hover,
.ql-snow.ql-toolbar .ql-picker-item.ql-selected,
.ql-snow.ql-toolbar .ql-picker-item:hover,
.ql-snow.ql-toolbar .ql-picker-label.ql-active,
.ql-snow.ql-toolbar .ql-picker-label:hover,
.ql-snow.ql-toolbar button.ql-active,
.ql-snow.ql-toolbar button:focus,
.ql-snow.ql-toolbar button:hover {
    color: var(--first-color) !important;
}

.ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-fill,
.ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke.ql-fill,
.ql-snow .ql-toolbar .ql-picker-item:hover .ql-fill,
.ql-snow .ql-toolbar .ql-picker-item:hover .ql-stroke.ql-fill,
.ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-fill,
.ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke.ql-fill,
.ql-snow .ql-toolbar .ql-picker-label:hover .ql-fill,
.ql-snow .ql-toolbar .ql-picker-label:hover .ql-stroke.ql-fill,
.ql-snow .ql-toolbar button.ql-active .ql-fill,
.ql-snow .ql-toolbar button.ql-active .ql-stroke.ql-fill,
.ql-snow .ql-toolbar button:focus .ql-fill,
.ql-snow .ql-toolbar button:focus .ql-stroke.ql-fill,
.ql-snow .ql-toolbar button:hover .ql-fill,
.ql-snow .ql-toolbar button:hover .ql-stroke.ql-fill,
.ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-fill,
.ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke.ql-fill,
.ql-snow.ql-toolbar .ql-picker-item:hover .ql-fill,
.ql-snow.ql-toolbar .ql-picker-item:hover .ql-stroke.ql-fill,
.ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-fill,
.ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke.ql-fill,
.ql-snow.ql-toolbar .ql-picker-label:hover .ql-fill,
.ql-snow.ql-toolbar .ql-picker-label:hover .ql-stroke.ql-fill,
.ql-snow.ql-toolbar button.ql-active .ql-fill,
.ql-snow.ql-toolbar button.ql-active .ql-stroke.ql-fill,
.ql-snow.ql-toolbar button:focus .ql-fill,
.ql-snow.ql-toolbar button:focus .ql-stroke.ql-fill,
.ql-snow.ql-toolbar button:hover .ql-fill,
.ql-snow.ql-toolbar button:hover .ql-stroke.ql-fill {
    fill: var(--first-color) !important;
}
</style>
