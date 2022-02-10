<template>
    <section v-if="opinions.length > 0" class="opinions">
        <img
            v-lazy="`${origin}/storage/img/stock/opinions-ellipse.svg`"
            alt="elipsa"
            class="ellipse"
        />
        <div class="content">
            <div class="section-content">
                <img
                    class="bolt"
                    v-lazy="`${origin}/storage/img/home/bolt.png`"
                    alt=""
                />
                <h3
                    class="section-title"
                    v-html="prepareTitle(opinionsDesc.title)"
                ></h3>
            </div>

            <div class="opinions-container">
                <div
                    v-for="(opinion, i) in opinions"
                    :key="`opinion-${i}`"
                    class="opinion"
                >
                    <div class="opinion-container">
                        <div class="author">
                            <img
                                class="avatar"
                                v-lazy="
                                    `${origin}/storage/media/${opinion.photo}`
                                "
                                :alt="opinion.photo_alt"
                            />
                            <div>
                                <b class="name">{{ opinion.title }}</b>
                                <p class="date">
                                    {{
                                        new Date(
                                            opinion.created_at
                                        ).toLocaleString()
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="stars">
                            <img
                                v-for="(star, j) in opinion.stars"
                                :key="`opinion-${i}-star-${j}`"
                                class="star star-filled"
                                v-lazy="
                                    `${origin}/storage/img/stock/star-filled.svg`
                                "
                                alt="gwiazdka wypełniona"
                            />
                            <img
                                v-for="(star, j) in 5 - opinion.stars"
                                :key="`opinion-${i}-star-${j}`"
                                class="star star-outline"
                                v-lazy="
                                    `${origin}/storage/img/stock/star-outline.svg`
                                "
                                alt="gwiazdka pusta"
                            />
                        </div>
                        <div
                            class="description"
                            v-html="opinion.short_description"
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
        opinions: {
            deep: true,
            handler() {
                if (this.opinions.length > 0) this.emitData();
            }
        }
    },
    data() {
        return {
            origin: window.location.origin
        };
    },
    created() {
        this.fetchData();
        this.$store.dispatch("opinionsDesc");
    },
    methods: {
        prepareTitle: title =>
            title?.replaceAll("{", "<span>").replaceAll("}", "</span>"),
        emitData() {
            this.$emit("blockDataEmit", this.opinions);
        },
        fetchData() {
            this.$store.dispatch("opinions");
        },
        async reloadData() {
            this.$store.commit("opinions", []);
            await this.fetchData();
            this.emitData();
        }
    },
    computed: {
        opinions() {
            return this.$store.getters.opinions;
        },
        opinionsDesc() {
            return this.$store.getters.opinionsDesc;
        },
        opinions_old() {
            return [
                {
                    photo: "opinion-1.png",
                    photo_alt: "opinion 1",
                    first_name: "Jan",
                    last_name: "Kowalski",
                    stars: 5,
                    description:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sollicitudin rhoncus ante eget iaculis. Integer placerat sed dolor quis pharetra.",
                    created_at: "2021-09-12 18:00:23"
                },
                {
                    photo: "opinion-2.png",
                    photo_alt: "opinion 2",
                    first_name: "Jan",
                    last_name: "Kowalski",
                    stars: 4,
                    description:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sollicitudin rhoncus ante eget iaculis. Integer placerat sed dolor quis pharetra.",
                    created_at: "2021-09-12 18:00:23"
                },
                {
                    photo: "opinion-3.png",
                    photo_alt: "opinion 3",
                    first_name: "Jan",
                    last_name: "Kowalski",
                    stars: 5,
                    description:
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sollicitudin rhoncus ante eget iaculis. Integer placerat sed dolor quis pharetra.",
                    created_at: "2021-09-12 18:00:23"
                }
            ];
        }
    }
};
</script>

<style lang="scss" scoped>
section.opinions {
    position: relative;
    z-index: 1;
    overflow: hidden;

    .ellipse {
        position: absolute;
        left: 50%;
        top: 0;
    }
    .content {
        position: relative;
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

        .opinions-container {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            .opinion {
                width: 33.33%;
                margin-bottom: 1rem;
                background-color: white;

                @media (min-width: 992px) {
                    &:nth-child(3n + 2) {
                        padding-left: 0.8rem;
                        padding-right: 0.8rem;
                    }
                }
                @media (max-width: 992px) {
                    width: 100%;
                }
                .opinion-container {
                    box-shadow: 0px 10px 40px #0000000f;
                    padding: 1.7rem;
                    border-radius: 12px;
                    height: 100%;
                    .author {
                        display: flex;
                        align-items: center;
                        .avatar {
                            height: 60px;
                            border-radius: 100%;
                            margin-right: 1rem;
                        }
                        .name {
                            font-weight: 700;
                            font-size: 1.1rem;
                        }
                        .date {
                            margin-bottom: 0;
                            font-weight: 600;
                            font-size: 1rem;
                        }
                    }

                    .stars {
                        display: flex;
                        padding-top: 1.2rem;
                        padding-bottom: 0.5rem;
                        .star {
                            height: 15px;
                            padding-right: 0.2rem;
                        }
                    }
                    .description {
                        font-weight: 600;
                    }
                }
            }
        }
    }
}
</style>
