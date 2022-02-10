<template>
    <v-content>
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Wysyłanie maila do użytkowników
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row class="px-5">
                        <v-col cols="12">
                            <v-text-field
                                color="primary"
                                :rules="rules.titleRules"
                                v-model="mail.subject"
                                label="Temat Twojej wiadomości"
                            ></v-text-field>
                            <v-textarea
                                color="primary"
                                :rules="rules.titleRules"
                                rows="5"
                                v-model="mail.message"
                                label="Twoja wiadomość"
                            ></v-textarea>
                            <Select @users="users = $event"></Select>
                        </v-col>
                    </v-row>

                    <v-divider class="mb-0"></v-divider>

                    <v-card-actions class="pa-4">
                        <v-btn
                            :loading="loading"
                            :disabled="!valid || users.length == 0"
                            color="primary"
                            class="mr-2"
                            @click="saveMail"
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
    </v-content>
</template>

<script>
import axios from "axios";
import Select from "../../../components/select/Users";

export default {
    data() {
        return {
            files: [],
            mail: {
                subject: "",
                message: "",
                newsletter: true
            },
            users: [],
            loading: false,
            valid: true,
            rules: {
                titleRules: [v => !!v || "To pole jest wymagane!"]
            }
        };
    },
    components: {
        Select
    },
    methods: {
        deleteMail(mail) {
            axios.delete("/api/mails/delete/" + mail.id);
        },
        async sendMail(mail) {
            let i = 0;
            for (let user of this.users) {
                mail.email = user.email;
                mail.newsletter = 1;
                if (i == this.users.length - 1) mail.delete = 1;
                await axios
                    .post("/api/mails/send", mail)
                    .then(res => {
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
                        if (i == this.users.length - 1) {
                            if (res.data.success) {
                                this.$refs.form.reset();
                                this.$refs.form.resetValidation();
                                this.deleteMail(mail);
                            }
                        }
                    })
                    .catch(err => {
                        console.log(err);
                        this.loading = false;
                        this.$store.commit(
                            "setSnackbar",
                            "Przepraszamy, nie udało się wysłać maila..."
                        );
                    });
                i++;
            }
        },
        async saveAttachments(mail) {
            for (let i = 0; i < this.files.length; i++) {
                let formData = new FormData();
                formData.append("file", this.files[i]);
                formData.append("mail_id", mail.id);
                await axios
                    .post("/api/attachments/add", formData)
                    .then(res => {
                        if (i == this.files.length - 1) this.sendMail(mail);
                    })
                    .catch(err => {
                        this.loading = false;
                        console.log(err);
                        this.$store.commit(
                            "setSnackbar",
                            "Przepraszamy, nie udało się wysłać załączników..."
                        );
                    });
            }
        },
        saveMail() {
            if (!this.valid) return;

            this.loading = true;
            axios
                .post("/api/mails/add", this.mail)
                .then(res => {
                    if (this.files.length > 0) this.saveAttachments(res.data);
                    else this.sendMail(res.data);
                })
                .catch(err => {
                    console.log(err);
                    this.loading = false;
                    this.$store.commit(
                        "setSnackbar",
                        "Przepraszamy, błąd serwera..."
                    );
                });
        }
    }
};
</script>
