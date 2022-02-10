<template>
    <section class="execution-process">
        <div class="content">
            <div class="section-content">
                <img
                    class="bolt"
                    v-lazy="`${origin}/storage/img/home/bolt.png`"
                    alt=""
                />
                <h3 class="section-title">{{ executionProcessDesc.title }}</h3>
            </div>
            <div class="steps">
                <div
                    v-for="(step, i) in executionProcess"
                    :key="`step-${i}`"
                    class="step"
                >
                    <div class="icon-section">
                        <div class="icon-container">
                            <img
                                class="icon"
                                v-lazy="`${origin}/storage/media/${step.photo}`"
                                :alt="step.photo_alt"
                            />
                        </div>
                        <div
                            v-if="
                                i !== executionProcess.length - 1 ||
                                    innerWidth <= 992
                            "
                            class="separator"
                        ></div>
                    </div>
                    <div class="step-title">{{ step.title }}</div>
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
        executionProcess: {
            deep: true,
            handler() {
                if (this.executionProcess.length > 0) this.emitData();
            }
        }
    },
    data() {
        return {
            origin: window.location.origin,
            innerWidth: window.innerWidth,
            table: "executionProcess"
        };
    },
    computed: {
        executionProcess() {
            return this.$store.getters.executionProcess;
        },
        executionProcessDesc() {
            return this.$store.getters.executionProcessDesc;
        }
    },
    methods: {
        emitData() {
            this.$emit("blockDataEmit", this.executionProcess);
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
section.execution-process {
    .content {
        padding: var(--global-padding-x-desktop);
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

            .bolt {
                padding-right: 1.3rem;
                @media (max-width: 400px) {
                    margin-bottom: 0.5rem;
                }
            }
        }
        .icon-section {
            display: flex;
            align-items: center;
            width: 100%;
            .icon-container {
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid var(--first-color);
                border-radius: 100%;
                padding: 1.5rem;
                .icon {
                    height: 60px;
                }
            }
            .separator {
                background-color: var(--first-color);
                margin: 0 1.2rem;
                height: 1px;
                width: 100%;
            }
        }
        .steps {
            display: flex;
            flex-wrap: wrap;
            .step {
                width: 25%;
                margin-bottom: 1.5rem;
                @media (max-width: 992px) {
                    width: 100%;
                }
                .step-title {
                    margin-top: 1rem;
                    font-weight: 600;
                    font-size: 1rem;
                }
            }
        }
    }
}
</style>
