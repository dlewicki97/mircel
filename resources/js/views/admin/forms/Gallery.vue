<template>
    <v-content class="">
        <v-container>
            <v-card>
                <v-card-title class="justify-content-center">
                    <h2
                        v-if="formTitle != 'undefined undefined'"
                        class=" pt-4 font-weight-bold panel-title-header first-color"
                    >
                        {{
                            $route.path.split("/")[2] == "realizations"
                                ? "Realizacje"
                                : "Galeria - " + formTitle
                        }}
                    </h2>
                </v-card-title>
                <v-divider class="mt-0"></v-divider>
                <v-form ref="form">
                    <v-row>
                        <v-col class="" cols="12" md="8">
                            <div class="pa-5">
                                <div class="gallery-container">
                                    <v-row>
                                        <v-col
                                            v-for="photo in gallery"
                                            :key="photo.path"
                                            cols="12"
                                            sm="6"
                                            md="4"
                                        >
                                            <div class="position-relative">
                                                <img
                                                    class="img-fluid"
                                                    :src="getUrl(photo.path)"
                                                    alt=""
                                                />
                                                <div
                                                    class="close-icon-container"
                                                >
                                                    <v-icon
                                                        v-if="photo.id"
                                                        @click="
                                                            destroy(photo.id)
                                                        "
                                                        class="pr-1 pt-1 close-icon"
                                                        color="grey"
                                                        >mdi-close</v-icon
                                                    >
                                                </div>
                                            </div>
                                            <v-text-field
                                                label="Tekst alternatywny"
                                                v-model="photo.photo_alt"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </div>
                            </div>
                        </v-col>

                        <v-col cols="12" md="4">
                            <div
                                class="pa-5 d-flex flex-column justify-content-between"
                            >
                                <div>
                                    <ImagePicker
                                        @updateDeletedPhoto="updateDeletedPhoto"
                                        :activePhotoPath="currentObject.photo"
                                        @loadedImage="setImagePlaceholder"
                                        :img="img"
                                        :apiGallery="apiGallery"
                                    />
                                </div>
                            </div>
                        </v-col>
                    </v-row>
                    <v-divider class="mb-0"></v-divider>
                    <v-card-actions class="pa-4">
                        <v-btn color="primary" class="mr-2" @click="send">
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
import axios from "axios";
import ImagePicker from "../../../components/image-picker/ImagePicker";
import SnackbarAlerts from "../../../data/snackbar-alerts.js";
import url from "../../../helpers/photo/url.js";

export default {
    data: () => ({
        name: "",
        rules: {
            titleRules: [v => !!v || "Tytuł jest wymagany!"]
        },
        apiGallery: [],
        pickedGallery: [],
        gallery: [],
        currentObject: {},
        activePhoto: "https://via.placeholder.com/250",
        img: ""
    }),
    computed: {
        formTitle() {
            if (this.$route.path.split("/")[2] == "players")
                return `${this.currentObject.first_name} ${this.currentObject.last_name}`;
            else return this.currentObject.title;
        }
    },
    methods: {
        getUrl(src) {
            return url(src);
        },
        getImageDefaultPlaceholder() {
            return "https://via.placeholder.com/250";
        },
        setGallery(event) {
            let pickedGallery = [];
            for (let photo of event) {
                pickedGallery.push({
                    path: photo,
                    photo_alt: "",
                    item_id: this.$route.params.id,
                    table_name: this.$route.params.table
                });
            }
            this.pickedGallery = pickedGallery;
            this.gallery = [...this.apiGallery, ...this.pickedGallery];
        },
        setImagePlaceholder(event) {
            if (event === "placeholder") {
                (this.img = ""),
                    (this.activePhoto = this.getImageDefaultPlaceholder());
            } else {
                this.setGallery(event);
                this.activePhoto = url(event);
            }
        },
        getFormData() {
            return this.gallery;
        },
        resetForm() {
            this.activePhoto = this.getImageDefaultPlaceholder();
        },
        setLoading(state) {
            this.$store.commit("loading", state);
        },
        add(formData) {
            axios
                .post(`/api/gallery/add`, formData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(res => {
                    this.setLoading(false);
                    this.$store.commit("setSnackbar", SnackbarAlerts.success);
                    this.loadGallery();
                    this.resetForm();
                })
                .catch(err => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.error);
                    this.setLoading(false);
                });
        },
        edit(formData) {
            axios
                .put(`/api/gallery/edit`, formData, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(res => {
                    this.setLoading(false);
                    this.$store.commit("setSnackbar", SnackbarAlerts.success);
                    this.loadGallery();
                })
                .catch(err => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.error);
                    this.setLoading(false);
                    console.log(err);
                });
        },
        destroy(id) {
            if (!confirm("Czy na pewno chcesz usunąć to zdjęcie?")) return;
            this.setLoading(true);
            axios
                .delete("/api/gallery/delete/" + id)
                .then(res => {
                    this.setLoading(false);
                    this.$store.commit("setSnackbar", SnackbarAlerts.success);
                    this.loadGallery();
                })
                .catch(err => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.error);
                    this.setLoading(false);
                    console.log(err);
                });
        },
        send() {
            this.setLoading(true);
            for (let photo of this.getFormData())
                photo.id ? this.edit(photo) : this.add(photo);
        },
        updateDeletedPhoto() {
            this.edit(this.getFormData());
        },
        loadCurrentObject() {
            axios
                .get(
                    `/api/${this.$route.path.split("/")[2]}/get_one/${
                        this.$route.params.id
                    }`
                )
                .then(res => {
                    this.currentObject = res.data;
                });
        },
        loadGallery() {
            axios
                .get(
                    `/api/gallery/get_photos/${
                        this.$route.path.split("/")[2]
                    }/${this.$route.params.id}`
                )
                .then(res => {
                    this.apiGallery = res.data;
                    this.gallery = res.data;
                    this.setLoading(false);
                });
        }
    },
    components: {
        ImagePicker
    },
    created() {
        if (this.$route.path.split("/")[2] != "realizations")
            this.loadCurrentObject();
        this.loadGallery();
        this.setLoading(true);
    }
};
</script>

<style>
.gallery-form-photo {
    background-size: cover;
    width: 100%;
    height: auto;
    margin: auto;
}

.close-icon {
    /*filter: invert(1);*/
}
.close-icon-container {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: flex-start;
}
</style>
