<template>
    <section class="header">
        <router-link to="/">
            <img
                v-if="settings.photo"
                class="logo"
                :src="`${origin}/storage/media/${settings.photo}`"
                alt=""
            />
        </router-link>
        <ul v-show="showCollapseMenuClasses">
            <router-link
                :to="`${subpage.path}`"
                v-for="(subpage, i) in subpages"
                :key="`subpage-${i}`"
            >
                <li>
                    <div class="border-line"></div>
                    {{ subpage.title }}
                </li>
            </router-link>
        </ul>
        <a
            v-show="showCollapseMenuClasses"
            class="phone"
            :href="`tel:${contact.phone_1}`"
        >
            <img
                class="phone-icon"
                :src="`${origin}/storage/img/layout/phone.svg`"
                alt=""
            />
            {{ contact.phone_1 }}
        </a>
        <img
            @click="showMobileMenuHandler"
            class="hamburger-menu"
            :src="`${origin}/storage/img/layout/hamburger-menu.svg`"
            alt=""
        />
    </section>
</template>

<script>
import url from "@/helpers/photo/url.js";

export default {
    data() {
        return {
            origin: window.location.origin,
            showMobileMenu: false,
            windowWidth: window.innerWidth
        };
    },
    computed: {
        subpages() {
            return [
                { title: "USŁUGI", path: "/uslugi" },
                { title: "REALIZACJE", path: "/realizacje" },
                { title: "FOTOWOLTAIKA", path: "/fotowoltaika" },
                { title: "KONTAKT", path: "/kontakt" }
            ];
        },
        settings() {
            return this.$store.getters.settings;
        },
        contact() {
            return this.$store.getters.contact;
        },
        isScreenMobileDevice() {
            return this.windowWidth <= 992;
        },
        showCollapseMenuClasses() {
            return this.isScreenMobileDevice ? this.showMobileMenu : true;
        }
    },
    methods: {
        url,
        showMobileMenuHandler() {
            this.showMobileMenu = !this.showMobileMenu;
        },
        onResize() {
            this.windowWidth = window.innerWidth;
        }
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener("resize", this.onResize);
        });
    },

    beforeDestroy() {
        window.removeEventListener("resize", this.onResize);
    }
};
</script>

<style lang="scss">
section.header {
    $header-padding-y: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: $header-padding-y var(--global-padding-x-desktop);
    height: 100%;
    @media (max-width: 992px) {
        flex-wrap: wrap;
        height: unset;
        padding-left: var(--global-padding-x-mobile);
        padding-right: var(--global-padding-x-mobile);
    }
    .logo {
        height: 60px;
        @media (max-width: 992px) {
            order: 1;
        }
    }
    .phone {
        display: flex;
        align-items: center;
        padding: 0.7rem 1.3rem;
        border-radius: var(--global-border-radius);
        transition: 0.2s background-color;
        color: black;
        font-size: 1.4rem;
        font-weight: 500;
        @media (max-width: 992px) {
            order: 4;
            width: fit-content;
            justify-content: center;
        }
        .phone-icon {
            height: 18px;
            padding-right: 1.2rem;
        }

        &:hover {
            background-color: var(--first-color);
            color: white;
            img {
                filter: invert(1);
            }
        }
    }

    ul {
        list-style-type: none;
        display: flex;
        align-items: center;
        margin-bottom: 0;
        height: 100%;
        padding-left: 0;
        @media (max-width: 992px) {
            order: 3;
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            padding-top: 1rem;
        }
        & > a {
            height: 100%;
        }
        li {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            color: #000;
            font-size: 1.1rem;
            font-weight: 500;
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;

            transition: 0.2s color;
            &::before {
                display: none;
            }
            @media (max-width: 992px) {
                padding: 0.5rem;

                .border-line {
                    transform: unset !important;
                }
            }

            &:hover {
                color: var(--first-color);
                .border-line {
                    opacity: 1;
                }
            }
            .border-line {
                transition: 0.2s opacity;
                position: absolute;
                opacity: 0;
                top: 0;
                left: 0;
                height: 0.3rem;
                width: 100%;
                transform: translateY(calc(-#{$header-padding-y} - 0.1rem));
                background-color: var(--first-color);
                border-bottom-left-radius: var(--global-border-radius);
                border-bottom-right-radius: var(--global-border-radius);
            }
        }
    }

    .hamburger-menu {
        color: black;
        height: 20px;
        display: none;
        @media (max-width: 992px) {
            display: block;
            order: 2;
        }
    }
}
</style>
