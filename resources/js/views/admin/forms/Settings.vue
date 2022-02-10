<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Ustawienia {{ formTitle }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col class="" cols="12" md="8">
                            <div class="pa-5">
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.company"
                                    :rules="rules.titleRules"
                                    label="Nazwa Strony *"
                                    required
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.recaptcha_site_token"
                                    label="Captcha klucz witryny"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="
                                        currentObject.recaptcha_secret_token
                                    "
                                    label="Captcha klucz prywatny"
                                ></v-text-field>
                                <div class="mt-3">
                                    <p class="mb-1">Opis w stopce</p>
                                    <vue-editor
                                        v-model="currentObject.description"
                                    ></vue-editor>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-1">
                                        Zgoda na przetwarzanie danych (rodo1)
                                    </p>
                                    <v-textarea
                                        v-model="currentObject.rodo_1"
                                    ></v-textarea>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-1">
                                        Zgoda na kontakt telefoniczny (rodo2)
                                    </p>
                                    <v-textarea
                                        v-model="currentObject.rodo_2"
                                    ></v-textarea>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-1">Cookies</p>
                                    <v-textarea
                                        v-model="currentObject.cookies"
                                    ></v-textarea>
                                </div>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.cookies_button"
                                    label="Tekst na przycisku cookies"
                                ></v-text-field>
                                <v-text-field
                                    color="primary"
                                    v-model="
                                        currentObject.cookies_privace_button
                                    "
                                    label="Tekst linku polityki prywatności (cookies)"
                                ></v-text-field>
                            </div>
                        </v-col>

                        <v-col cols="12" md="4">
                            <div
                                class="pa-5 d-flex flex-column justify-content-between"
                            >
                                <div>
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
                                </div>

                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.photo_alt"
                                    label="Tekst alternatywny loga"
                                ></v-text-field>
                            </div>
                            <div
                                class="pa-5 d-flex flex-column justify-content-between"
                            >
                                <div>
                                    <div
                                        v-if="currentObject.privace_policy"
                                        class="w-100 d-flex justify-content-between align-items-center"
                                    >
                                        <a target="_blank" :href="activeFile">
                                            <div>
                                                {{
                                                    currentObject.privace_policy.split(
                                                        "/"
                                                    )[
                                                        currentObject.privace_policy.split(
                                                            "/"
                                                        ).length - 1
                                                    ]
                                                }}
                                            </div>
                                        </a>
                                        <v-btn
                                            @click="
                                                currentObject.privace_policy =
                                                    ''
                                            "
                                            icon
                                        >
                                            <v-icon>mdi-close</v-icon>
                                        </v-btn>
                                    </div>
                                    <FilePicker
                                        @loadFiles="fetchFiles"
                                        :loadFlag="loadFlag"
                                        :title="'Polityka prywatności'"
                                        @updateDeletedFile="updateDeletedFile"
                                        :activeFilePath="
                                            currentObject.privace_policy
                                        "
                                        @loadedFile="
                                            currentObject.privace_policy = $event
                                        "
                                    />
                                </div>
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
            loadFlag: false,
            currentObject: {
                company: "",
                rodo_1: "",
                rodo_2: "",
                photo: "",
                photo_alt: "",
                privace_policy: "",
                shop_regulations: "",
                description: "",
                cookies: "",
                cookies_button: "",
                cookies_privace_button: ""
            }
        };
    },
    ...vueComponents,
    methods: {
        ...vueComponents.methods,
        fetchFiles(e) {
            this.loadFlag = true;
            setTimeout(() => (this.loadFlag = false), 200);
        }
    }
};
</script>
