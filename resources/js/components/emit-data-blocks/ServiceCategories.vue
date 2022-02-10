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
            serviceCategories: []
        };
    },
    methods: {
        getData() {
            this.$store.commit("loading", true);
            axios
                .get(`/api/service_categories/get_all`)
                .then(res => {
                    this.$store.commit("loading", false);
                    this.serviceCategories = res.data;
                    this.$emit("blockDataEmit", this.serviceCategories);
                    this.$store.commit("serviceCategories", res.data);
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
