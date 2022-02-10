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
            mails: []
        };
    },
    methods: {
        async getData() {
            this.$store.commit("loading", true);
            await axios
                .get(`/api/mails/get_all`)
                .then(res => {
                    this.$store.commit("loading", false);
                    this.mails = res.data;

                    this.$emit(
                        "blockDataEmit",
                        this.mails.sort(
                            (a, b) =>
                                new Date(b.created_at) - new Date(a.created_at)
                        )
                    );
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
