<template>
    <v-main>
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Odpowiedź na mail o temacie '{{ mail.subject }}'
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row class="px-5">
                        <v-col cols="12" md="8">
                            <v-textarea
                                color="primary"
                                :rules="rules.titleRules"
                                rows="5"
                                v-model="answer.answer_message"
                                label="Twoja wiadomość"
                            ></v-textarea>
                        </v-col>
                        <v-col class="" cols="12" md="4">
                            <div class="pa-5">
                                <v-text-field
                                    color="primary"
                                    disabled
                                    v-model="mail.name"
                                    label="Imię i nazwisko"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    disabled
                                    v-model="mail.email"
                                    label="E-mail"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    disabled
                                    v-model="mail.phone"
                                    label="Telefon"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    disabled
                                    v-model="mail.subject"
                                    label="Temat"
                                ></v-text-field>
                                <v-textarea
                                    color="primary"
                                    rows="5"
                                    disabled
                                    v-model="mail.message"
                                    label="Wiadomość"
                                ></v-textarea>
                            </div>
                        </v-col>
                    </v-row>

                    <v-divider class="mb-0"></v-divider>

                    <v-card-actions class="pa-4">
                        <v-btn
                            :loading="loading"
                            :disabled="!valid"
                            color="primary"
                            class="mr-2"
                            @click="editMail"
                        >
                            <v-icon left>mdi-check</v-icon>
                            <span>Wyślij</span>
                        </v-btn>

                        <v-btn
                            color="error"
                            class="mr-2"
                            @click="$router.go(-1)"
                        >
                            <v-icon left>mdi-close</v-icon>
                            <span>Wróć</span>
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-container>
    </v-main>
</template>
<script>
import axios from "axios";
import attachment from "../../../helpers/attachments/link.js";
import Vue from "vue";
import { VueReCaptcha } from "vue-recaptcha-v3";

export default {
    data() {
        return {
            mail: {},
            loading: false,
            answer: {
                answer_message: "",
                answer: 1,
                id: this.$route.params.id,
                subject: "",
                email: ""
            },
            files: [],
            rules: {
                titleRules: [v => !!v || "To pole jest wymagane!"]
            },
            valid: true,
            attachments: []
        };
    },
    watch: {
        mail() {
            this.answer.subject = this.mail.subject;
            this.answer.email = this.mail.email;
        }
    },
    methods: {
        getMail() {
            axios
                .get(`/api/mails/get_one/${this.$route.params.id}`)
                .then(res => {
                    this.mail = res.data;
                });
        },
        getAttachment(src) {
            return attachment(src);
        },
        sendMail(mail) {
            mail.delete = 1;
            axios
                .post("/api/mails/send", mail)
                .then(res => {
                    console.log(res);
                    this.loading = false;
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

                    this.$store.commit(
                        "setSnackbar",
                        "Pomyślnie wysłano odpowiedź!"
                    );
                })
                .catch(err => {
                    console.log(err);
                    this.loading = false;
                    this.$store.commit(
                        "setSnackbar",
                        "Przepraszamy, nie udało się wysłać maila..."
                    );
                });
        },

        editMail() {
            if (!this.valid) return;
            this.loading = true;
            axios
                .put("/api/mails/answer", this.answer)
                .then(res => {
                    this.sendMail(res.data);
                })
                .catch(err => {
                    this.loading = false;
                    this.$store.commit(
                        "setSnackbar",
                        "Nie udało się zapisać wiadomości, skontaktuj się z Danielem"
                    );
                });
        }
    },
    created() {
        this.getMail();
        Vue.use(VueReCaptcha, {
            siteKey: "6Lfdvf0cAAAAAAMO211eYJE2wG8AlbWfQZQwbIS5"
        });
    }
};
</script>
