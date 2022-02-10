<template>
    <section class="solar-systems-page">
        <section
            class="solar-systems"
            v-if="Object.entries(solarSystem).length > 0"
        >
            <div class="content">
                <div class="section-content">
                    <img
                        class="bolt"
                        v-lazy="`${origin}/storage/img/home/bolt.png`"
                        alt=""
                    />
                    <h3
                        class="section-title"
                        v-html="prepareTitle(solarSystem.title)"
                    ></h3>
                </div>

                <div
                    class="short-description"
                    v-html="solarSystem.short_description"
                ></div>
            </div>
            <div class="position-relative photo-container">
                <div
                    class="photo bg"
                    :title="solarSystem.photo_alt"
                    v-lazy:background-image="
                        `${origin}/storage/media/${solarSystem.photo}`
                    "
                ></div>
            </div>
        </section>
        <CallUs />
    </section>
</template>

<script>
import CallUs from "@/components/pages/solarSystems/CallUs";

export default {
    components: { CallUs },
    data() {
        return {
            origin: window.location.origin,
            solarSystems: {
                photo: "img/stock/solar-systems.jpg",
                photo_alt: "fotowoltaika"
            }
        };
    },
    methods: {
        prepareTitle(title) {
            return title?.replace("{", "<span>").replace("}", "</span>");
        }
    },
    computed: {
        solarSystem() {
            return this.$store.getters.solarSystem;
        }
    },
    created() {
        this.$store.dispatch("solarSystem");
    }
};
</script>

<style lang="scss" scoped>
@mixin mircel-padding {
    padding-left: var(--global-padding-x-desktop);
    @media (max-width: 992px) {
        padding-left: var(--global-padding-x-mobile);
        padding-right: var(--global-padding-x-mobile);
    }
}
section.solar-systems-page {
    position: relative;
}
section.solar-systems {
    display: flex;
    flex-wrap: wrap;
    padding-top: 7rem;
    z-index: 1;
    position: relative;
    margin-bottom: 7rem;
    .content,
    .photo-container {
        width: 50%;
        @media (max-width: 992px) {
            width: 100%;
            order: 1;
        }
    }

    .photo {
        position: relative;
        z-index: 2;
        height: 200px;
        border-bottom-left-radius: var(--global-border-radius);
        border-top-left-radius: var(--global-border-radius);
        @media (max-width: 992px) {
            margin-bottom: 3rem;
        }
    }

    .content {
        position: relative;
        @include mircel-padding;
        @media (max-width: 992px) {
            order: 2;
        }
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

        .short-description {
            font-size: 1rem;
            font-weight: 600;
            line-height: 17px;
            margin-top: 1rem;
        }

        a.phone-link {
            display: flex;
            margin-top: 3rem;
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
