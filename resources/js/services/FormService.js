import axios from "axios";
import ImagePicker from "../components/image-picker/ImagePicker";
import FilePicker from "../components/file-picker/FilePicker";
import SnackbarAlerts from "../data/snackbar-alerts.js";
import url from "../helpers/photo/url.js";
import TagsInput from "../components/tagsinput/TagsInput.vue";
import AdminPanelBlocks from "../data/admin-panel-blocks.js";
import { VueEditor } from "vue2-editor";

export default {
    data: {
        valid: true,
        name: "",
        rules: {
            titleRules: [v => !!v || "To pole jest wymagane!"],
            positiveRules: [v => v > 0 || "To pole musi być większe od zera!"],
            nonNegativeRules: [v => v > -1 || "To pole nie może być ujemne!"],
            priceRules: [
                v =>
                    (v * 1000) % 10 == 0 ||
                    "To pole musi mieć max. dwa miejsca po przecinku!"
            ],
            amountRules: [
                v => v % 1 == 0 || "To pole musi być liczbą całkowitą!"
            ]
        },
        activePhoto:
            window.location.origin + "/storage/img/placeholder/250.png",
        activeFile: "",
        parent: {}
    },
    computed: {
        formTitle() {
            return this.$route.params.id ? "Edycja" : "Dodawanie";
        },
        parentTable() {
            let parentTable = "";
            Object.entries(AdminPanelBlocks).forEach(block => {
                block[1].forEach(table => {
                    if (table.tablename == this.$route.path.split("/")[2]) {
                        parentTable = block[1][0].parent
                            ? block[1][0].parent
                            : "";
                    }
                });
            });
            return parentTable;
        }
    },
    methods: {
        getUrl: src => url(src),
        getParent() {
            axios
                .get(
                    `/api/${this.parentTable}/get_one/${this.$route.params.parent_id}`
                )
                .then(res => (this.parent = res.data))
                .catch(err => console.log(err));
        },
        getImageDefaultPlaceholder() {
            return window.location.origin + "/storage/img/placeholder/250.png";
        },
        setImagePlaceholder(event) {
            if (event === "placeholder") {
                (this.currentObject.photo = ""),
                    (this.activePhoto = this.getImageDefaultPlaceholder());
            } else {
                this.activePhoto = url(event);
                this.currentObject.photo = event;
            }
        },
        setFilePlaceholder(event) {
            if (event === "placeholder") {
                (this.currentObject.file = ""), (this.activeFile = "");
            } else {
                this.activeFile = url(event);
                this.currentObject.file = event;
            }
        },
        getFormData() {
            delete this.currentObject.created_at;
            delete this.currentObject.updated_at;
            return this.currentObject;
        },
        resetForm() {
            this.currentObject = {};
            this.activePhoto = this.getImageDefaultPlaceholder();
        },
        redirect() {
            let redirect = "";
            Object.entries(AdminPanelBlocks).forEach(block => {
                block[1].forEach(table => {
                    if (table.tablename == this.$route.path.split("/")[2]) {
                        redirect = `/${block[0]}`;
                        if (this.$route.params.parent_id)
                            redirect = `${redirect}/${this.$route.params.parent_id}`;
                    }
                });
            });
            let hash = this.$route.params.parent_id
                ? ""
                : `#${this.$route.path.split("/")[2]}`;
            this.$router.push(`/admin-panel${redirect}${hash}`);
        },
        add(formData) {
            axios
                .post(`/api/${this.$route.path.split("/")[2]}/add`, formData)
                .then(res => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.success);
                    this.resetForm();
                    this.redirect();
                })
                .catch(err => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.error);
                });
        },
        edit(formData) {
            axios
                .put(`/api/${this.$route.path.split("/")[2]}/edit`, formData)
                .then(res => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.success);
                    this.redirect();
                })
                .catch(err => {
                    this.$store.commit("setSnackbar", SnackbarAlerts.error);
                    console.log(err);
                });
        },
        validate() {
            let formData = this.getFormData();
            this.$route.params.id ? this.edit(formData) : this.add(formData);
        },
        updateDeletedPhoto() {
            this.edit(this.getFormData());
        },
        updateDeletedFile() {
            this.edit(this.getFormData());
        },
        secureRoutes() {
            let user = JSON.parse(localStorage.getItem("user"));
            let status = false;
            if (user) {
                if (user.type == "Admin" || user.type == "Moderator") {
                    status = true;
                }
            }
            if (!status)
                this.$router.push(
                    `/admin-panel/${this.$route.path.split("/")[2]}`
                );
        }
    },
    components: {
        ImagePicker,
        TagsInput,
        VueEditor,
        FilePicker
    },
    created() {
        if (this.$route.params.id) {
            axios
                .get(
                    `/api/${this.$route.path.split("/")[2]}/get_one/${
                        this.$route.params.id
                    }`
                )
                .then(res => {
                    this.activePhoto =
                        res.data.photo !== null
                            ? url(res.data.photo)
                            : this.activePhoto;
                    this.activeFile =
                        res.data.file !== null
                            ? url(res.data.file)
                            : this.activeFile;
                    this.currentObject = res.data;
                });
        }
        if (this.$route.params.parent_id) this.getParent();

        this.secureRoutes();
    }
};
