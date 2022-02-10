<template>
    <div class="text-center">
        <v-bottom-sheet v-model="sheet">
            <v-sheet
                class="pa-3 align-items-center d-flex justify-content-between"
            >
                <div class="pr-3">
                    {{ $store.getters.settings.cookies
                    }}<a
                        target="_blank"
                        :href="url($store.getters.settings.privace_policy)"
                        >{{
                            " " + $store.getters.settings.cookies_privace_button
                        }}</a
                    >
                </div>

                <v-btn color="primary" @click="accept">{{
                    $store.getters.settings.cookies_button
                }}</v-btn>
            </v-sheet>
        </v-bottom-sheet>
    </div>
</template>

<script>
import url from "@/helpers/photo/url";

export default {
    data() {
        return {
            url,
            sheet: true
        };
    },
    methods: {
        accept() {
            this.sheet = false;
            sessionStorage.setItem("cookies", true);
        }
    },
    created() {
        this.sheet = sessionStorage.getItem("cookies") ? false : true;
    }
};
</script>
