<template>
    <section v-if="slides.length > 0" class="slider">
        <carousel
            class="slider-carousel"
            :items="1"
            :nav="false"
            @update="update"
            :loop="true"
            :autoplay="true"
            :autoplaySpeed="2000"
        >
            <div
                v-for="(slide, i) in slides"
                :key="`slide-${i}`"
                class="slide bg"
                :title="slide.photo_alt"
                :style="
                    `background-image: url(${origin}/storage/media/${slide.photo})`
                "
            >
                <div class="content">
                    <h2 class="slide-title">{{ slide.title }}</h2>
                    <p class="slide-subtitle">{{ slide.subtitle }}</p>
                    <router-link class="mr-2" :to="slide.button_link_1">
                        <button class="button first-button">
                            {{ slide.button_name_1 }}
                        </button>
                    </router-link>
                    <router-link :to="slide.button_link_2">
                        <button class="button second-button">
                            {{ slide.button_name_2 }}
                        </button>
                    </router-link>
                </div>
                <div class="mask"></div>
            </div>
        </carousel>
    </section>
</template>

<script>
import carousel from "vue-owl-carousel2";

export default {
    props: ["reloadFlag"],
    watch: {
        reloadFlag() {
            if (this.reloadFlag) this.reloadData();
        },
        data() {
            this.emitData();
        }
    },
    data() {
        return {
            origin: window.location.origin,
            table: "slider"
        };
    },
    components: {
        carousel
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
        },
        update(data) {
            console.log(data);
        }
    },
    computed: {
        data() {
            return this.$store.getters[this.table];
        },
        slides() {
            return this.data.filter(slide => slide.active);
        }
    },
    created() {
        this.fetchData();
    }
};
</script>

<style scoped lang="scss">
section.slider {
    .slide {
        height: 500px;
        background-position: 50% 50%;
        display: flex;
        align-items: center;
        position: relative;
        .content {
            position: relative;
            z-index: 1;
            padding-left: var(--global-padding-x-desktop);
            width: 50%;
            @media (max-width: 992px) {
                width: 100%;
                padding-left: var(--global-padding-x-mobile);
            }
            .slide-title,
            .slide-subtitle {
                color: white;
                text-shadow: 0 0 10px black;
            }
            .slide-title {
                font-size: 2.9rem !important;
                font-weight: 600;
            }
            .slide-subtitle {
                font-size: 1.4rem !important;
                font-weight: 300;
            }
        }

        .mask {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(
                to right,
                rgb(0 0 0 / 69%) 0%,
                rgba(0, 0, 0, 0) 41%
            );
        }
    }
    .slider-carousel {
        .owl-dots {
            position: absolute !important;
            bottom: 0;
            transform: translateY(50%);
        }
        .owl-carousel > .slide {
            display: none !important;
        }
    }
}
</style>

<style lang="scss">
section.slider {
    .slider-carousel {
        .owl-dots {
            position: absolute !important;
            left: 50%;
            bottom: 0;
            transform: translate(-50%, 50%);
            margin-top: 0 !important;
            align-items: center;
            display: flex;
            justify-content: center;
            background-color: #fff;
            border-radius: 15px;
            padding: 0.3rem 0.5rem;

            .owl-dot {
                &.active span,
                &:hover span {
                    background-color: var(--first-color);
                }
                span {
                    $dot-dimensions: 14px;
                    width: $dot-dimensions;
                    height: $dot-dimensions;
                    margin-left: 4px;
                    margin-right: 4px;
                    transition: 0.2s background-color;
                    background-color: #efefef;
                }
            }
        }
    }
}
</style>
