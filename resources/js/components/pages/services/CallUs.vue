<template>
    <section class="call-us" v-if="Object.entries(servicesCallUs).length > 0">
        <img
            v-lazy="`${origin}/storage/img/services/solar-system-ellipse.svg`"
            alt="elipsa"
            class="ellipse"
        />
        <div
            class="bg"
            :title="servicesCallUs.photo_alt"
            v-lazy:background-image="
                `${origin}/storage/media/${servicesCallUs.photo}`
            "
        >
            <div class="mask"></div>
            <div class="content">
                <h3 class="section-title" v-html="servicesCallUs.title"></h3>

                <a class="phone-link" :href="`tel:${contact.phone_1}`">
                    <div class="icon-container">
                        <img
                            v-lazy="
                                `${origin}/storage/img/home/about/phone.svg`
                            "
                            alt="słuchawka"
                        />
                    </div>
                    <div class="phone-content">
                        {{ servicesCallUs.button_name }}
                        <span class="number">{{ contact.phone_1 }}</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            origin: window.location.origin
        };
    },
    computed: {
        servicesCallUs() {
            return this.$store.getters.servicesCallUs;
        },
        contact() {
            return this.$store.getters["contact"];
        }
    },
    created() {
        this.$store.dispatch("servicesCallUs");
    }
};
</script>

<style lang="scss" scoped>
section.call-us {
    position: relative;
    @mixin borders-radius {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .ellipse {
        position: absolute;
        right: -10%;
        top: -130%;
        height: 700px;
        @media (max-width: 992px) {
            display: none;
        }
    }
    .bg {
        @include borders-radius;
        position: relative;
        .mask {
            @include borders-radius;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent
                linear-gradient(90deg, #00000073 0%, #00000000 38%) 0% 0%
                no-repeat padding-box;
        }
    }
    .content {
        padding: 3rem var(--global-padding-x-desktop);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        @media (max-width: 992px) {
            padding-left: var(--global-padding-x-mobile);
            padding-right: var(--global-padding-x-mobile);
            flex-direction: column;
        }
        .section-title {
            color: white;
            text-shadow: 0 0 10px black;
            @media (max-width: 992px) {
                text-align: center;
            }
        }

        a.phone-link {
            display: flex;

            background-color: white;
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
            @media (max-width: 992px) {
                margin-top: 3rem;
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
