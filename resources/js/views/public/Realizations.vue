<template>
    <section class="realizations-page">
        <CoolLightBox
            :items="
                realizations.map(
                    photo => `${origin}/storage/media/${photo.path}`
                )
            "
            :index="index"
            @close="index = null"
        >
        </CoolLightBox>
        <div class="content">
            <div
                v-for="(realization, i) in realizations"
                :key="`realization-${i}`"
                class="realization"
                @click="index = i"
            >
                <div class="wrapper">
                    <div
                        class="photo"
                        :title="realization.photo_alt"
                        v-lazy:background-image="
                            `${origin}/storage/media/${realization.path}`
                        "
                    ></div>

                    <div class="text">{{ realization.photo_alt }}</div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CoolLightBox from "vue-cool-lightbox";
import "vue-cool-lightbox/dist/vue-cool-lightbox.min.css";

export default {
    components: {
        CoolLightBox
    },
    props: ["reloadFlag"],
    watch: {
        reloadFlag() {
            if (this.reloadFlag) this.reloadData();
        }
    },
    data() {
        return {
            origin: window.location.origin,
            table: "realizations",
            index: null
        };
    },
    computed: {
        realizations() {
            return this.$store.getters.realizations;
        }
    },
    methods: {
        emitData() {
            this.$emit("blockDataEmit", this.data);
        },
        fetchData() {
            this.$store.dispatch(this.table);
        },
        async reloadData() {
            this.$store.commit(this.table, []);
            await this.fetchData();
            this.emitData();
        }
    },
    created() {
        this.fetchData();
    }
};
</script>

<style lang="scss" scoped>
@mixin mircel-padding {
    padding-left: var(--global-padding-x-desktop);
    padding-right: var(--global-padding-x-desktop);
    @media (max-width: 992px) {
        padding-left: var(--global-padding-x-mobile);
        padding-right: var(--global-padding-x-mobile);
    }
}
section.realizations-page {
    margin-top: 7rem;
    margin-bottom: 7rem;
    .content {
        @include mircel-padding;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        .realization {
            width: 25%;
            cursor: pointer;
            border-radius: 12px;
            background-color: #fff;
            @media (max-width: 992px) {
                width: 100%;
            }
            padding: 0.3rem;
            .wrapper {
                border-radius: 12px;
                padding: 1rem;
                height: 100%;
                background-color: var(--first-color);
                .photo {
                    background-size: cover;
                    border-radius: 12px;
                    background-repeat: no-repeat;
                    background-position: center;
                    width: 100%;
                    height: 200px;
                }

                .text {
                    margin-top: 1rem;
                    color: white;
                    font-weight: 600;
                    font-size: 1.1rem;
                }
            }
        }
    }
}
</style>
