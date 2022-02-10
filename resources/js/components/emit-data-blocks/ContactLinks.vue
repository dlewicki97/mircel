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
            contactLinks: []
        };
    },
    methods: {
        getData() {
            this.$store.commit("loading", true);
            axios
                .get(`/api/contact_links/get_all`)
                .then(res => {
                    this.$store.commit("loading", false);
                    this.contactLinks = res.data;
                    this.$emit("blockDataEmit", this.contactLinks);
                    this.$store.commit("contactLinks", res.data);
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
