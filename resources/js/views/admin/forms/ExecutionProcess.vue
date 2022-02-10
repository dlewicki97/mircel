<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Proces wykonania usługi {{ formTitle }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col class="" cols="12" md="8">
                            <div class="pa-5">
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.title"
                                    :rules="rules.titleRules"
                                    label="Tytuł *"
                                    required
                                ></v-text-field>
                            </div>
                        </v-col>
                        <v-col cols="12" md="4">
                            <div class="pa-5">
                                <v-img
                                    :src="activePhoto"
                                    :alt="currentObject.photo_alt"
                                ></v-img>
                                <ImagePicker
                                    @updateDeletedPhoto="updateDeletedPhoto"
                                    :activePhotoPath="currentObject.photo"
                                    @loadedImage="setImagePlaceholder"
                                    :img="currentObject.photo"
                                />

                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.photo_alt"
                                    label="Tekst alternatywny zdjęcia"
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
            currentObject: {
                title: "",
                photo: "",
                photo_alt: ""
            }
        };
    },
    ...vueComponents
};
</script>
