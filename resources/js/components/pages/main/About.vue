<template>
    <section v-if="about.id && contact.id" class="about">
        <div class="content">
            <div class="section-content">
                <img
                    class="bolt"
                    v-lazy="`${origin}/storage/img/home/bolt.png`"
                    alt=""
                />
                <h3
                    class="section-title"
                    v-html="prepareTitle(about.title)"
                ></h3>
            </div>

            <div class="description" v-html="about.short_description"></div>

            <a class="phone-link" :href="`tel:${contact.phone_1}`">
                <div class="icon-container">
                    <img
                        v-lazy="`${origin}/storage/img/home/about/phone.svg`"
                        alt="słuchawka"
                    />
                </div>
                <div class="phone-content">
                    {{ about.button_name }}
                    <span class="number">{{ contact.phone_1 }}</span>
                </div>
            </a>
        </div>
        <div class="position-relative photo-container">
            <div
                class="photo bg"
                title="about.photo_alt"
                v-lazy:background-image="
                    `${origin}/storage/media/${about.photo}`
                "
            ></div>
            <img
                class="ellipse"
                v-lazy="`${origin}/storage/img/home/ellipse1.svg`"
                alt="elipsa"
            />
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
        about: {
            deep: true,
            handler() {
                if (this.about.id) this.emitData();
            }
        }
    },
    data() {
        return {
            origin: window.location.origin,
            table: "about"
        };
    },
    computed: {
        about() {
            return this.$store.getters.about;
        },
        contact() {
            return this.$store.getters.contact;
        }
    },
    methods: {
        prepareTitle(title) {
            return title.replace("{", "<span>").replace("}", "</span>");
        },
        emitData() {
            this.$emit("blockDataEmit", [this.about]);
        },
        fetchData() {
            this.$store.dispatch(this.table);
        },
        async reloadData() {
            this.$store.commit(this.table, {});
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
section.about {
    display: flex;
    flex-wrap: wrap;
    padding-top: 7rem;
    z-index: 1;

    .content,
    .photo-container {
        width: 50%;
        @media (max-width: 992px) {
            width: 100%;
        }

        .ellipse {
            position: absolute;
            bottom: 0;
            left: 0;
            transform: translate(-50%, 50%);
            height: 170px;
            z-index: 0;
        }
    }

    .photo {
        position: relative;
        z-index: 2;
        height: 300px;
        border-bottom-left-radius: var(--global-border-radius);
        border-top-left-radius: var(--global-border-radius);
        @media (max-width: 992px) {
            margin-top: 3rem;
        }
    }

    .content {
        padding-left: var(--global-padding-x-desktop);
        @media (max-width: 992px) {
            padding-left: var(--global-padding-x-mobile);
            padding-right: var(--global-padding-x-mobile);
        }
        z-index: 3;
        .section-content {
            display: flex;
            align-items: center;
            @media (max-width: 400px) {
                flex-direction: column;
            }
            .bolt {
                height: 75px;
                padding-right: 1.3rem;
                @media (max-width: 400px) {
                    margin-bottom: 0.5rem;
                }
            }
        }

        .description {
            font-size: 1rem;
            font-weight: 600;
            line-height: 17px;
            margin-top: 1rem;
        }

        a.phone-link {
            display: flex;
            margin-top: 3rem;
            background-color: #fff;
            @mixin box-shadow {
                box-shadow: 0px 10px 40px #0000000f;
            }
            @include box-shadow;
            border-radius: var(--global-border-radius);
            width: fit-content;
            padding: 1rem 2rem;
            transition: 0.2s background-color;
            @media (max-width: 400px) {
                flex-direction: column;
                align-items: center;
                width: 100%;
                padding-left: 1rem;
                padding-right: 1rem;
            }
            &:hover {
                background-color: var(--first-color);
                .phone-content,
                .phone-content span {
                    color: white;
                }
            }
            .icon-container {
                width: 50px;
                height: 50px;
                border-radius: 12px;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #fff;
                @include box-shadow;
                img {
                    height: 20px;
                }
            }

            .phone-content {
                font-size: 1rem;
                display: flex;
                flex-direction: column;
                font-weight: 600;
                line-height: 26px;
                padding-left: 2rem;
                color: black;
                @media (max-width: 400px) {
                    padding-left: 0;
                    margin-top: 1rem;
                    width: 100%;
                }
                span {
                    font-size: 1.8rem;
                    font-weight: 700;
                    color: #333333;
                }
            }
        }
    }
}
</style>
