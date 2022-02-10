<template>
    <section class="footer" v-if="Object.entries(settings).length > 0">
        <iframe
            v-if="false"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d80010.04443349653!2d15.929875154430135!3d51.19486761297717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470f142675c2f169%3A0xc369de331944c85e!2sGiera%C5%82towiec%2017%2C%2059-511%20Giera%C5%82towiec!5e0!3m2!1spl!2spl!4v1632676763479!5m2!1spl!2spl"
            width="100%"
            height="200"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
        ></iframe>

        <div class="content">
            <section class="descriptions">
                <router-link :to="{ name: 'Main' }">
                    <img
                        class="logo"
                        :src="`${origin}/storage/media/${settings.photo}`"
                        alt="settings.photo_alt"
                    />
                </router-link>
                <hr class="footer-logo-separator" />
                <div class="description" v-html="settings.description"></div>
            </section>
            <section class="links">
                <div class="column">
                    <h4>Menu</h4>
                    <ul>
                        <li
                            v-for="(subpage, i) in subpages"
                            :key="`footer-subpage-${i}`"
                        >
                            <router-link :to="subpage.page">{{
                                subpage.title
                            }}</router-link>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <h4>{{ settings.company }}</h4>
                    <ul>
                        <li>
                            <a :href="`tel:${contact.phone_1}`">{{
                                contact.phone_1
                            }}</a>
                        </li>
                        <li>
                            <a :href="`mailto:${contact.email_1}`">{{
                                contact.email_1
                            }}</a>
                        </li>
                        <li>
                            <a
                                target="_blank"
                                :href="
                                    `https://www.google.com/search?tbm=lcl&sxsrf=ALeKk03R-n9i9FnjZJDGGG_KGJOJQtjFRQ%3A1604163272211&ei=yJadX-mpDJKJrwT3w42AAg&q=${contact.address},+${contact.zip_code}+${contact.city}&oq=bilard+&gs_l=psy-ab.3.0.35i39k1j0i67k1j0l8.10333.16284.0.16901.13.13.0.0.0.0.190.1120.0j7.7.0....0...1c.1.64.psy-ab..6.7.1120...46j0i433i131k1j46i67k1j0i433i67k1j0i10k1j0i203k1j0i433k1.0.d23hfgOs4ts#rlfi=hd:;si:9035433236648356783;mv:[[51.390375377319025,16.199153519032567],[51.39001542268097,16.19857668096743]]`
                                "
                                >{{
                                    `${contact.address}, ${contact.zip_code} ${contact.city}`
                                }}</a
                            >
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <hr class="footer-separator" />
        <div class="copyright">
            Copyright Ⓒ by {{ settings.company }}. All rights reserved.
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
        subpages() {
            return this.$store.getters.subpages;
        },
        contact() {
            return this.$store.getters.contact;
        },
        settings() {
            return this.$store.getters.settings;
        }
    }
};
</script>

<style lang="scss">
section.footer {
    $footer-font-size: 1.1rem;
    $footer-color: #ece9f5;
    $footer-separator-color: #9287bd;

    background-color: var(--first-color);

    .content {
        display: flex;
        flex-wrap: wrap;
        padding: 3rem var(--global-padding-x-desktop);
        @media (max-width: 992px) {
            padding-bottom: 0;
            padding-left: var(--global-padding-x-mobile);
            padding-right: var(--global-padding-x-mobile);
        }
        section.descriptions {
            width: 33.33%;
            @media (max-width: 992px) {
                width: 100%;
                margin-bottom: 2rem;
            }
            .logo {
                height: 80px;
                filter: brightness(120);
                margin-bottom: 0.7rem;
            }
            .footer-logo-separator {
                border-color: $footer-separator-color;
                border-width: 2px;
            }
            .description {
                color: $footer-color;
                font-size: $footer-font-size;
                line-height: 25px;
            }
        }
        section.links {
            width: 66.67%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            @media (max-width: 992px) {
                width: 100%;
                justify-content: center;
                flex-direction: column;
            }
            .column {
                @media (max-width: 992px) {
                    margin-bottom: 1rem;
                }
                h4 {
                    font-size: 1.5rem;
                    color: white;
                }
                ul {
                    list-style-type: none;
                    padding-left: 0;
                    li {
                        color: inherit;
                        font-size: $footer-font-size;
                        &::before {
                            display: none;
                        }
                        a {
                            color: $footer-color;
                        }
                        &.bold {
                            font-weight: 700;
                        }
                    }
                }
            }
        }
    }
    .footer-separator {
        border-color: $footer-separator-color;
        border-width: 2px;
        margin-bottom: 0;
    }
    .copyright {
        padding: 2rem var(--global-padding-x-desktop);
        color: #e4ddeb;
        font-size: 1rem;
        @media (max-width: 992px) {
            padding-left: var(--global-padding-x-mobile);
            padding-right: var(--global-padding-x-mobile);
        }
    }
}
</style>
