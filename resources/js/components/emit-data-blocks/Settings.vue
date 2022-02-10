<template></template>

<script>
import axios from "axios";

export default {
    props: ["reloadFlag"],
    watch: {
        reloadFlag() {
            if (this.reloadFlag) this.getData();
        }
    },
    data() {
        return {
            settings: {}
        };
    },
    methods: {
        getData() {
            this.$store.commit("loading", true);
            axios
                .get(`/api/settings/get_one/1`)
                .then(res => {
                    this.$store.commit("loading", false);
                    this.settings = res.data;
                    this.$emit("blockDataEmit", [this.settings]);
                    this.$store.commit("settings", res.data);
                })
                .catch(err => {
                    this.$store.commit("loading", false);
                    console.log(err);
                });
        }
    },
    created() {
        this.getData();
    }
};
</script>
