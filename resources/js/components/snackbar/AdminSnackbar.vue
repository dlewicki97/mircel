<template>
    <div class="text-center">
        <v-snackbar color="primary" v-model="snackbar" right bottom>
            <div v-html="text"></div>

            <template v-slot:action="{ attrs }">
                <v-btn
                    class="snackbar-button"
                    color="white"
                    text
                    v-bind="attrs"
                    @click="unsetSnackbar"
                >
                    Zamknij
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>

<script>
export default {
    watch: {
        snackbar() {
            setTimeout(() => {
                this.unsetSnackbar();
            }, 3000);
        }
    },
    methods: {
        unsetSnackbar() {
            this.$store.commit("unsetSnackbar");
        }
    },
    computed: {
        snackbar() {
            return this.$store.getters.getSnackbar;
        },
        text() {
            return this.$store.getters.getSnackbarText;
        }
    }
};
</script>

<style scoped>
.snackbar-button {
    color: white;
}
</style>
