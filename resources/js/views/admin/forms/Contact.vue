<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Dane kontaktowe {{ formTitle }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col class="" cols="12">
                            <div class="pa-5">
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.email_1"
                                    :rules="rules.titleRules"
                                    label="E-mail formularz (na ten email będą przychodzić maile z formularzy) *"
                                ></v-text-field>

                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.phone_1"
                                    label="Telefon 1"
                                ></v-text-field>

                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.address"
                                    label="Adres"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.zip_code"
                                    label="Kod Pocztowy"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.city"
                                    label="Miasto"
                                ></v-text-field>
                            </div>
                        </v-col>
                    </v-row>
                    <v-divider class="mb-0"></v-divider>
                    <v-card-actions class="pa-4">
                        <v-btn
                            :disabled="!valid"
                            color="primary"
                            class="mr-2"
                            @click="validate"
                        >
                            <v-icon left>mdi-check</v-icon>
                            <span>Zatwierdź</span>
                        </v-btn>

                        <v-btn
                            color="error"
                            class="mr-2"
                            @click="$router.go(-1)"
                        >
                            <v-icon left>mdi-close</v-icon>
                            <span>Anuluj</span>
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-container>
    </v-content>
</template>

<script>
import FormService from "../../../services/FormService.js";
let data = {};
let vueComponents = {};

Object.entries(FormService).forEach(form =>
    form[0] != "data" ? (vueComponents[form[0]] = form[1]) : (data = form[1])
);

export default {
    data() {
        return {
            ...data,
            currentObject: {
                name: "",
                email_1: "",
                email_2: "",
                phone_1: "",
                phone_2: "",
                address: "",
                city: "",
                zip_code: "",
                map: "",
                fb: "",
                yt: "",
                ig: "",
                tw: ""
            }
        };
    },
    ...vueComponents
};
</script>
