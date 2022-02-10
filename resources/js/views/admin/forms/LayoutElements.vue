<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Elementy Layoutu {{ formTitle }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col cols="12" md="8">
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
                            <div
                                class="pa-5 d-flex flex-column justify-content-between"
                            >
                                <h3>Tocząca się bila na stronie głównej</h3>
                                <div>
                                    <v-img
                                        :src="
                                            currentObject.eight_ball
                                                ? getUrl(
                                                      currentObject.eight_ball
                                                  )
                                                : getImageDefaultPlaceholder()
                                        "
                                        :alt="currentObject.eight_ball_alt"
                                    ></v-img>
                                    <ImagePicker
                                        @updateDeletedPhoto="updateDeletedPhoto"
                                        :activePhotoPath="
                                            currentObject.eight_ball
                                        "
                                        @loadedImage="
                                            $event == 'placeholder'
                                                ? (currentObject.eight_ball =
                                                      '')
                                                : (currentObject.eight_ball = $event)
                                        "
                                        :img="currentObject.eight_ball"
                                    />
                                </div>

                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.eight_ball_alt"
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
                title: ""
            }
        };
    },
    ...vueComponents
};
</script>
