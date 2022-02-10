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
            servicesAttributes: []
        };
    },
    methods: {
        getData() {
            this.$store.commit("loading", true);
            axios
                .get(`/api/services_attributes/get_all`)
                .then(res => {
                    this.$store.commit("loading", false);
                    this.servicesAttributes = res.data;
                    this.$emit("blockDataEmit", this.servicesAttributes);
                    this.$store.commit("servicesAttributes", res.data);
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
