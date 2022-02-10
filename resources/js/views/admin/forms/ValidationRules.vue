<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Błędy walidacji formularzy {{ formTitle }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col class="" cols="12">
                            <div class="pa-5">
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.required"
                                    label="To pole jest wymagane!"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.email"
                                    label="Niepoprawny e-mail."
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.password_length"
                                    label="Hasło musi mieć co najmniej 8 liter!"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.file_size"
                                    label="Zdjęcie powinno ważyć mniej niż 5 MB!"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.password_confirm"
                                    label="Hasła muszą być takie same!"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.reservation_min_time"
                                    label="Minimalny czas rezerwacji to 30 minut!"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.reservation_exist"
                                    label="Taka rezerwacja już istnieje!"
                                    required
                                ></v-text-field>
                            </div>
                        </v-col>
                    </v-row>
                    <v-divider class="mb-0"></v-divider>
                    <v-card-actions class="pa-4">
                        <v-btn
                            :disabled="!valid || currentObject.title == ''"
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
            currentObject: {}
        };
    },
    ...vueComponents
};
</script>
