<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Logowanie
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form
                    v-if="validationRules.id"
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-row>
                        <v-col cols="12">
                            <div class="pa-5">
                                <v-text-field
                                    color="primary"
                                    v-model="credentials.email"
                                    :rules="[required, email]"
                                    label="Adres E-mail"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    type="password"
                                    color="primary"
                                    :rules="[required, passwordLength]"
                                    v-model="credentials.password"
                                    label="Hasło"
                                ></v-text-field>

                                <v-btn
                                    color="primary"
                                    class="mr-2"
                                    @click="login"
                                    :loading="loading"
                                >
                                    <v-icon left>mdi-check</v-icon>
                                    <span class="button-name">Zaloguj</span>
                                </v-btn>
                            </div>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card>
        </v-container>
    </v-content>
</template>

<script>
export default {
    data() {
        return {
            valid: true,
            credentials: {
                password: "",
                email: ""
            },
            loading: false
        };
    },
    computed: {
        validationRules() {
            return this.$store.getters.validationRules;
        }
    },
    methods: {
        required(v) {
            return !!v || this.validationRules.required;
        },
        email(v) {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return pattern.test(v) || this.validationRules.email;
        },
        passwordLength(v) {
            return v.length >= 8 || this.validationRules.password_length;
        },
        async login() {
            if (this.$refs.form.validate()) {
                this.loading = true;
                await this.$store.dispatch("authLogin", this.credentials);
                this.loading = false;
            }
        }
    },
    async created() {
        if (localStorage.getItem("user"))
            this.$router.push({
                name: "AdminHome"
            });
        await this.$store.dispatch("validationRules");
    }
};
</script>

<style scoped>
.panel-title-header {
    font-size: 3rem;
}
.button-name {
    color: white;
}
</style>
