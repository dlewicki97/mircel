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
            contact: {}
        };
    },
    methods: {
        getContact() {
            this.$store.commit("loading", true);
            axios
                .get(`/api/contact/get_one/1`)
                .then(res => {
                    this.$store.commit("loading", false);
                    this.contact = [res.data];
                    this.$emit("blockDataEmit", this.contact);
                    this.$store.commit("contact", res.data);
                })
                .catch(err => {
                    this.$store.commit("loading", false);
                    console.log(err);
                });
        }
    },
    created() {
        this.getContact();
    }
};
</script>
