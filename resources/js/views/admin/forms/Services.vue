<template>
    <v-main class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        Usługi {{ formTitle }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-row>
                        <v-col class="" cols="12" md="8">
                            <div class="pa-5">
                                <v-checkbox
                                    color="primary"
                                    label="Pokaż na stronie głównej"
                                    :input-value="currentObject.home_page"
                                    :value="currentObject.home_page"
                                    @change="currentObject.home_page = $event"
                                ></v-checkbox>
                                <v-text-field
                                    color="primary"
                                    v-model="currentObject.title"
                                    :rules="rules.titleRules"
                                    label="Tytuł *"
                                    required
                                ></v-text-field>
                                <div class="checkboxes">
                                    <p class="mb-1">Wybierz kategorie:</p>
                                    <v-checkbox
                                        v-for="(category,
                                        i) in serviceCategories"
                                        :key="`service-category-${i}`"
                                        color="primary"
                                        :label="
                                            category.title
                                                .replace('<br>', ' ')
                                                .replace('{', '')
                                                .replace('}', '')
                                        "
                                        :input-value="
                                            setCheckboxState(category.id)
                                        "
                                        @change="
                                            serviceCategoryChange(
                                                category.id,
                                                $event
                                            )
                                        "
                                    ></v-checkbox>
                                </div>

                                <div class="mt-3">
                                    <p class="mb-1">Krótki opis</p>
                                    <vue-editor
                                        v-model="
                                            currentObject.short_description
                                        "
                                    ></vue-editor>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-1">Opis</p>
                                    <vue-editor
                                        v-model="currentObject.description"
                                    ></vue-editor>
                                </div>
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
    </v-main>
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
                id: null,
                title: "",
                short_description: "",
                photo: "",
                photo_alt: "",
                service_categories: [],
                home_page: false
            }
        };
    },
    ...vueComponents,

    computed: {
        ...vueComponents.computed,
        serviceCategories() {
            return this.$store.getters.serviceCategories;
        },
        currentServiceCategories() {
            return this.$store.getters.currentServiceCategories.reduce(
                (total, row) => [...total, row.service_category_id],
                []
            );
        }
    },
    watch: {
        currentObject: {
            deep: true,
            async handler() {
                if (this.currentObject.id) {
                    await this.$store.dispatch(
                        "currentServiceCategories",
                        this.currentObject.id
                    );
                    this.currentObject.service_categories = this.currentServiceCategories;
                }
            }
        }
    },
    methods: {
        ...vueComponents.methods,
        serviceCategoryChange(categoryId, state) {
            state
                ? this.currentObject.service_categories.push(categoryId)
                : this.currentObject.service_categories.splice(
                      this.currentObject.service_categories.indexOf(categoryId),
                      1
                  );
        },
        setCheckboxState(categoryId) {
            return this.currentServiceCategories.includes(categoryId);
        }
    },
    mounted() {
        this.$store.dispatch("serviceCategories");
    },
    destroyed() {
        this.$store.commit("currentServiceCategories", []);
    }
};
</script>

<style lang="scss">
.checkboxes {
    label {
        margin-bottom: 0 !important;
    }
}
</style>
