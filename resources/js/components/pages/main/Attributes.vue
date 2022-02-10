<template>
    <section class="attributes">
        <div class="content">
            <div class="section-content">
                <img
                    class="bolt"
                    v-lazy="`${origin}/storage/img/home/bolt.png`"
                    alt=""
                />
                <h3
                    v-if="attributesDesc.id"
                    class="section-title"
                    v-html="prepareTitle(attributesDesc.title)"
                ></h3>
            </div>

            <div class="attributes-container">
                <div
                    v-for="(attribute, i) in attributes"
                    :key="`attribute-${i}`"
                    class="attribute"
                >
                    <div class="attribute-content">
                        <img
                            v-lazy="
                                `${origin}/storage/media/${attribute.photo}`
                            "
                            :alt="attribute.photo_alt"
                            class="icon"
                        />
                        <div
                            class="description"
                            v-html="prepareTitle(attribute.title)"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["reloadFlag"],
    watch: {
        reloadFlag() {
            if (this.reloadFlag) this.reloadData();
        },
        attributes: {
            deep: true,
            handler() {
                if (this.attributes.length > 0) this.emitData();
            }
        }
    },
    data() {
        return {
            origin: window.location.origin,
            table: "attributes"
        };
    },
    computed: {
        attributes() {
            return this.$store.getters[this.table];
        },
        attributesDesc() {
            return this.$store.getters[this.table + "Desc"];
        }
    },
    methods: {
        prepareTitle: title =>
            title.replaceAll("{", "<span>").replaceAll("}", "</span>"),
        emitData() {
            this.$emit("blockDataEmit", this.attributes);
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
        this.$store.dispatch(this.table + "Desc");
    }
};
</script>

<style lang="scss" scoped>
section.attributes {
    .content {
        padding: var(--global-padding-x-desktop);
        padding-top: 0;
        @media (max-width: 992px) {
            padding-left: var(--global-padding-x-mobile);
            padding-right: var(--global-padding-x-mobile);
        }
        .section-content {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;

            @media (max-width: 400px) {
                flex-direction: column;
            }
            .section-title {
                span {
                    font-weight: 700;
                }
            }

            .bolt {
                padding-right: 1.3rem;
                @media (max-width: 400px) {
                    margin-bottom: 0.5rem;
                }
            }
        }

        .attributes-container {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            .attribute {
                width: 33.33%;
                margin-bottom: 1rem;
                @media (max-width: 992px) {
                    width: 100%;
                }

                @media (min-width: 992px) {
                    &:nth-child(3n + 2) {
                        padding-left: 0.8rem;
                        padding-right: 0.8rem;
                    }
                }
                .attribute-content {
                    box-shadow: 0px 10px 40px #0000000f;
                    padding: 1.5rem 2rem;
                    display: flex;
                    align-items: center;
                    border-radius: 12px;
                    height: 100%;
                    @media (max-width: 320px) {
                        flex-direction: column;
                        .icon {
                            padding-right: 0 !important;
                            margin-bottom: 0.9rem;
                        }
                        .description {
                            text-align: center;
                        }
                    }
                    .icon {
                        height: 65px;
                        padding-right: 1.5rem;
                    }
                }
            }
        }
    }
}
</style>

<style lang="scss">
.attribute-content {
    .description {
        font-weight: 700 !important;
        font-size: 1rem;
        color: black;
        line-height: 19px;
        span {
            color: var(--first-color) !important;
        }
    }
}
</style>
