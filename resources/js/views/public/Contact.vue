<template>
    <section class="contact">
        <div class="links-container" v-if="contactLinks.length > 0">
            <div class="links">
                <div
                    class="link"
                    v-for="link in contactLinks"
                    :key="`contact-link-${link.id}`"
                >
                    <a
                        :href="link.link"
                        :target="link.link.includes(`http`) ? `_blank` : ``"
                        class="wrapper"
                    >
                        <img
                            v-lazy="`${origin}/storage/media/${link.photo}`"
                            :alt="link.photo_alt"
                        />
                        <div
                            class="text"
                            v-html="prepareBlockHtml(link.title)"
                        ></div>
                    </a>
                </div>
            </div>
            <img
                class="ellipse"
                v-lazy="`${origin}/storage/img/home/ellipse1.svg`"
                alt="elipsa"
            />
        </div>

        <form>
            <h2 class="contact-form-title">Formularz <b>kontakowy</b></h2>
            <div class="inputs">
                <div class="input-container">
                    <input
                        type="text"
                        v-model="formData.name"
                        placeholder="Imię i nazwisko"
                    />
                </div>
                <div class="input-container">
                    <input
                        type="email"
                        v-model="formData.email"
                        placeholder="Adres e-mail"
                    />
                </div>
                <div class="input-container">
                    <input
                        type="text"
                        v-model="formData.subject"
                        placeholder="Temat"
                    />
                </div>
                <div class="textarea-container">
                    <textarea
                        rows="5"
                        placeholder="Treść wiadomości"
                        v-model="formData.message"
                    ></textarea>
                </div>
            </div>

            <div class="checkboxes">
                <div class="checkbox" @click="formData.rodo1 = !formData.rodo1">
                    <div class="square-container">
                        <div class="square">
                            <img
                                :class="{ show: formData.rodo1 }"
                                v-lazy="
                                    `${origin}/storage/img/stock/white-check.svg`
                                "
                                alt=""
                            />
                        </div>
                    </div>
                    <div class="text">
                        {{ prepareRodo(settings.rodo_1) }}
                        <span style="color: red">*</span>
                    </div>
                </div>
                <div class="checkbox" @click="formData.rodo2 = !formData.rodo2">
                    <div class="square-container">
                        <div class="square">
                            <img
                                :class="{ show: formData.rodo2 }"
                                v-lazy="
                                    `${origin}/storage/img/stock/white-check.svg`
                                "
                                alt=""
                            />
                        </div>
                    </div>
                    <div class="text">
                        {{ prepareRodo(settings.rodo_2) }}
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button @click.prevent="saveMail" class="button first-button">
                    Wyślij
                </button>
            </div>
        </form>
        <img
            v-lazy="`${origin}/storage/img/contact/form-ellipse.svg`"
            alt=""
            class="form-ellipse"
        />
    </section>
</template>

<script>
import axios from "axios";
import Vue from "vue";
import { VueReCaptcha } from "vue-recaptcha-v3";

export default {
    data() {
        return {
            origin: window.location.origin,
            formData: {
                name: "",
                email: "",
                subject: "",
                message: "",
                rodo1: false,
                rodo2: false
            },
            formDataDefault: {
                name: "",
                email: "",
                subject: "",
                message: "",
                rodo1: false,
                rodo2: false
            }
        };
    },
    computed: {
        contact() {
            return this.$store.getters.contact;
        },
        settings() {
            return this.$store.getters.settings;
        },
        contactLinks() {
            return this.$store.getters.contactLinks;
        }
    },
    methods: {
        validation() {
            if (
                !Object.values(this.formData).every(value =>
                    value.constructor == String ? Boolean(value) : true
                )
            ) {
                this.$store.commit(
                    "setSnackbar",
                    "Wszystkie pola muszą być uzupełnione!"
                );
                return false;
            }
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if (!pattern.test(this.formData.email)) {
                this.$store.commit("setSnackbar", "Email jest nieprawidłowy!");
                return false;
            }
            if (!this.formData.rodo1) {
                this.$store.commit(
                    "setSnackbar",
                    "Proszę zaznaczyć potrzebne rodo!"
                );
                return false;
            }
            return true;
        },
        prepareBlockHtml(text) {
            return text.replace("{", "<b>").replace("}", "</b>");
        },
        prepareRodo(rodo) {
            return rodo
                ?.replaceAll("{NAZWA_FIRMY}", this.settings.company)
                .replaceAll(
                    "{ADRES_FIRMY}",
                    `${this.contact.address}, ${this.contact.zip_code} ${this.contact.city}`
                );
        },
        async sendMail(mail) {
            await axios
                .post("/api/mails/send", mail)
                .then(res => {
                    console.log(res);
                    this.$store.commit("loading", false);
                    if (res.data.error != undefined)
                        this.$store.commit(
                            "setSnackbar",
                            res.data.error.message
                        );
                    else if (res.data.success != undefined)
                        this.$store.commit(
                            "setSnackbar",
                            res.data.success.message
                        );

                    if (res.status == 200) {
                        this.$store.commit(
                            "setSnackbar",
                            "Pomyślnie wysłano wiadomość!"
                        );
                        this.formData = this.formDataDefault;
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.$store.commit("loading", false);
                    this.$store.commit(
                        "setSnackbar",
                        this.$store.getters.snackbarAlerts.mail_error
                    );
                });
        },

        async saveMail() {
            if (!this.validation()) {
                return;
            }

            this.$store.commit("loading", true);
            const response = await this.$recaptcha("login");
            if (!response) {
                this.$store.commit(
                    "setSnackbar",
                    this.$store.getters.snackbarAlerts.recaptcha_error
                );
                this.$store.commit("loading", false);
                return;
            }
            await axios
                .post("/api/mails/add", { ...this.formData, response })
                .then(res => {
                    console.log(res);
                    if (res.data.error != undefined) {
                        this.$store.commit(
                            "setSnackbar",
                            res.data.error.message
                        );
                        this.$store.commit("loading", false);
                        return;
                    } else this.sendMail(res.data);
                })
                .catch(err => {
                    console.log(err);
                    this.$store.commit("loading", false);
                    this.$store.commit(
                        "setSnackbar",
                        this.$store.getters.snackbarAlerts.error
                    );
                });
        }
    },
    created() {
        this.$store.dispatch("contactLinks");
        Vue.use(VueReCaptcha, {
            siteKey: "6Lfdvf0cAAAAAAMO211eYJE2wG8AlbWfQZQwbIS5"
        });
    }
};
</script>

<style lang="scss" scoped>
@mixin mircel-margin {
    margin-left: var(--global-padding-x-desktop);
    margin-right: var(--global-padding-x-desktop);
    @media (max-width: 992px) {
        margin-left: var(--global-padding-x-mobile);
        margin-right: var(--global-padding-x-mobile);
    }
}
section.contact {
    margin-bottom: 7rem;
    position: relative;
    .form-ellipse {
        position: absolute;
        bottom: -51%;
        left: -20%;
        height: 800px;
        @media (max-width: 992px) {
            left: 50%;
            transform: translateX(-50%);
            bottom: -800px;
        }
    }
    .links-container {
        position: relative;
        @include mircel-margin;
        .links {
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            margin-top: 5rem;
            margin-bottom: 5rem;
            position: relative;
            .link {
                width: 33.33%;
                padding: 0.3rem;
                border-radius: 12px;
                @media (min-width: 992px) {
                    &:nth-child(3n) {
                        padding-right: 0;
                    }
                    &:nth-child(3n - 2) {
                        padding-left: 0;
                    }
                }
                @media (max-width: 992px) {
                    width: 100%;
                }
                .wrapper {
                    display: block;
                    box-shadow: 0px 10px 40px #0000000f;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100%;
                    border-radius: 12px;
                    padding: 2rem;
                    background-color: #fff;
                    img {
                        height: 25px;
                        margin-bottom: 1rem;
                    }
                    .text {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        font-weight: 700;
                        justify-content: center;
                        color: black;
                        b {
                            color: var(--first-color);
                            text-align: center;
                        }
                    }
                }
            }
        }
        .ellipse {
            position: absolute;
            right: 0;
            bottom: 0;
            height: 125px;
            transform: translate(50%, calc(50% - 0.3rem));
            z-index: 1;
        }
    }

    form {
        position: relative;
        z-index: 2;
        @include mircel-margin;
        .contact-form-title {
            font-weight: 700;
            color: black;
            text-align: center;
            font-size: 2rem;
            b {
                color: var(--first-color);
            }
        }

        .inputs {
            display: flex;
            flex-wrap: wrap;
            .textarea-container {
                width: 100%;
            }
            .input-container {
                padding: 0.3rem;
                width: 33.33%;
                @media (max-width: 992px) {
                    width: 100%;
                }
                @media (min-width: 992px) {
                    &:nth-child(3n) {
                        padding-right: 0;
                    }
                    &:nth-child(3n - 2) {
                        padding-left: 0;
                    }
                }
            }
            .textarea-container {
                padding: 0.3rem;
            }

            input,
            textarea {
                border-radius: 12px;
                outline: unset;
                border: unset;
                padding: 1.6rem 1.5rem;
                background-color: #fff;
                box-shadow: 0px 10px 40px #0000000f;
                display: block;
                width: 100%;
                caret-color: var(--first-color);
                &::placeholder,
                & {
                    color: black;
                    font-weight: 600;
                    font-size: 1rem;
                }
            }
        }

        .checkboxes {
            display: flex;
            margin-top: 0.5rem;
            flex-wrap: wrap;
            .checkbox {
                display: flex;
                justify-content: space-between;
                width: 50%;
                cursor: pointer;
                margin-bottom: 1rem;
                @media (max-width: 992px) {
                    width: 100%;
                }
                .square-container {
                    background-color: #fff;
                    width: 25px;
                    height: 25px;
                    border-radius: 2px;
                    display: flex;
                    align-items: center;
                    box-shadow: 0px 2px 8px #0000000f;
                    justify-content: center;
                    .square {
                        border-radius: inherit;
                        background-color: var(--first-color);
                        width: 60%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 60%;
                        img {
                            height: 100%;
                            width: 100%;
                            &:not(.show) {
                                display: none;
                            }
                        }
                    }
                }
                .text {
                    font-weight: 600;
                    width: 94%;
                    font-size: 0.8rem;
                }
            }
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            button {
                padding-left: 4rem;
                padding-right: 4rem;
            }
        }
    }
}
</style>
