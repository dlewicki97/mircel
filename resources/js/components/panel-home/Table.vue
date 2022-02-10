<template>
    <v-card shaped class="">
        <v-card-title class="align-items-center pt-5">
            <h2 class="table-title first-color ma-0">Akcje</h2>
            <v-spacer></v-spacer>
            <v-text-field
                class="ma-0 pt-0"
                v-model="search"
                append-icon="mdi-magnify"
                label="Szukaj..."
                single-line
                hide-details
            ></v-text-field>
            <router-link
                v-if="block.multiple"
                class="form-link"
                :to="
                    `/admin-panel/${block.tablename}/${
                        block.parent ? `${$route.params.parent_id}/` : ''
                    }form`
                "
            >
                <v-btn class="first-bgc white--text ml-5">
                    <v-icon left class="">{{
                        block.add_button_icon
                            ? block.add_button_icon
                            : "mdi-plus"
                    }}</v-icon>
                    <span>{{
                        block.add_button_text ? block.add_button_text : "Dodaj"
                    }}</span>
                </v-btn>
            </router-link>
        </v-card-title>
        <v-data-table
            locale="pl"
            :headers="headers[i]"
            :items="block.table"
            :search="search"
            :items-per-page="5"
            :footer-props="{ 'items-per-page-options': [5, 10, 15] }"
            class="elevation-1"
            @page-count="pageCount = $event"
        >
            <template
                v-for="(checkbox, j) in templateCheckboxes"
                #[slot(checkbox)]="{ item }"
            >
                <div class="d-flex justify-content-center">
                    <v-checkbox
                        v-model="item[checkbox]"
                        @change="setCheckbox(block.tablename, item)"
                    ></v-checkbox>
                </div>
            </template>
            <template #item.name="{ item }">
                {{
                    block.split_name
                        ? `${item.first_name} ${item.last_name}`
                        : item.name
                }}
            </template>
            <template #item.entry="{ item }">
                {{ `${item.entry} - ${item.leave}` }}
            </template>
            <template #item.answer="{ item }">
                <div class="d-flex justify-content-center">
                    <v-checkbox v-model="item.answer" disabled></v-checkbox>
                </div>
            </template>
            <template #item.order_number="{ item }">
                <div class="d-flex justify-content-center">
                    <v-text-field v-model="item.order_number"></v-text-field>
                </div>
            </template>
            <template #item.is_paid="{ item }">
                <div class="d-flex justify-content-center">
                    <v-checkbox
                        @change="setCheckbox(block.tablename, item)"
                        v-model="item.is_paid"
                    ></v-checkbox>
                </div>
            </template>
            <template #item.order="{ item }">
                <div class="d-flex justify-content-center">
                    <v-text-field
                        @change="setCheckbox(block.tablename, item)"
                        v-model="item.order"
                    ></v-text-field>
                </div>
            </template>
            <template #item.sent="{ item }">
                <div class="d-flex justify-content-center">
                    <v-checkbox
                        :disabled="item.sent"
                        @change="setCheckbox(block.tablename, item)"
                        v-model="item.sent"
                    ></v-checkbox>
                </div>
            </template>
            <template #item.service_equipment="{ item }">
                {{ item.service_equipment.title }}
            </template>
            <template #item.actions="{ item }">
                <div class="d-flex justify-content-end">
                    <router-link
                        v-if="block.list"
                        class="form-link"
                        :to="`/admin-panel/${block.list}/${item.id}`"
                    >
                        <v-btn small color="primary" class="white--text mr-2">
                            <v-icon left class=""
                                >mdi-format-list-bulleted</v-icon
                            >
                            <span>Lista</span>
                        </v-btn>
                    </router-link>
                    <router-link
                        v-if="block.gallery"
                        class="form-link"
                        :to="
                            `/admin-panel/${block.tablename}/gallery/${item.id}`
                        "
                    >
                        <v-btn small color="warning" class="white--text mr-2">
                            <v-icon left class="">mdi-image-multiple</v-icon>
                            <span>Galeria</span>
                        </v-btn>
                    </router-link>
                    <router-link
                        v-if="!block.non_editable"
                        class="form-link"
                        :to="
                            `/admin-panel/${block.tablename}/${
                                block.parent
                                    ? `${$route.params.parent_id}/`
                                    : ''
                            }form/${item.id}`
                        "
                    >
                        <v-btn small color="primary" class="white--text mr-2">
                            <v-icon left class="">{{
                                block.edit_button_icon
                                    ? block.edit_button_icon
                                    : "mdi-pencil"
                            }}</v-icon>
                            <span>{{
                                block.edit_button_text
                                    ? block.edit_button_text
                                    : "Edytuj"
                            }}</span>
                        </v-btn>
                    </router-link>
                    <v-btn
                        v-if="block.removable"
                        @click="deleteItem(block, item)"
                        small
                        color="error"
                        class="white--text"
                    >
                        <v-icon left class="">mdi-close</v-icon>
                        <span>Usuń</span>
                    </v-btn>
                </div>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
import axios from "axios";
import snackbarAlerts from "@/data/snackbar-alerts";

export default {
    props: ["headers", "block", "i"],
    data() {
        return {
            search: "",
            templateCheckboxes: [
                "home_page",
                "active",
                "blocked",
                "is_paid",
                "sent"
            ]
        };
    },
    methods: {
        slot: checkbox => `item.${checkbox}`,
        getRecordName: (block, item) =>
            block.tablename == "users"
                ? item.name
                : block.tablename == "mails"
                ? item.subject
                : item.title,
        deleteItem(block, item) {
            let item_name =
                block.tablename == "users" ? "użytkownika" : "przedmiot";
            if (
                confirm(
                    `Na pewno chcesz usunąć trwale ${item_name} "${this.getRecordName(
                        block,
                        item
                    )}" z tabeli "${block.title}"? `
                )
            ) {
                this.$store.commit("loading", true);
                if (block.tablename == "users")
                    this.$store.dispatch("deleteUserComments", item.id);
                axios
                    .delete(`/api/${block.tablename}/delete/${item.id}`)
                    .then(res => {
                        this.$emit("reloadFlag", true);
                        this.$store.commit("loading", false);
                        this.$store.commit(
                            "setSnackbar",
                            snackbarAlerts.delete
                        );
                        if (block.tablename == "news")
                            this.$store.dispatch("deleteComments", item.id);
                        setTimeout(() => this.$emit("reloadFlag", false), 200);
                    })
                    .catch(err => {
                        this.$store.commit("loading", false);
                        this.$store.commit("setSnackbar", snackbarAlerts.error);
                        console.log(err);
                    });
            }
        },
        acceptReservation(item) {
            axios
                .post("/api/reservations/accept", item)
                .then(res => {
                    if (res.data.success)
                        this.$store.commit(
                            "setSnackbar",
                            res.data.success.message
                        );
                    if (res.data.error)
                        this.$store.commit(
                            "setSnackbar",
                            res.data.error.message
                        );
                    this.$emit("reloadFlag", true);
                    setTimeout(() => this.$emit("reloadFlag", false), 200);
                })
                .catch(err => {
                    console.log(err);
                    this.$store.commit("setSnackbar", snackbarAlerts.error);
                });
        },
        sendShippingConfirmation(item) {
            axios
                .post("/api/shop_orders/shipping_confirmation", item)
                .then(res => {
                    if (res.data.success)
                        this.$store.commit(
                            "setSnackbar",
                            res.data.success.message
                        );
                    if (res.data.error)
                        this.$store.commit(
                            "setSnackbar",
                            res.data.error.message
                        );
                    this.$emit("reloadFlag", true);
                    setTimeout(() => this.$emit("reloadFlag", false), 200);
                })
                .catch(err => {
                    console.log(err);
                    this.$store.commit("setSnackbar", snackbarAlerts.error);
                });
        },
        setCheckbox(table, item) {
            if (table == "reservations" && item.active)
                if (
                    !confirm(
                        "Czy na pewno potwierdzić rezerwację? Zostanie wysłane potwierdzenie na maila użytkownika!"
                    )
                ) {
                    this.block.table.find(
                        row => item.id == row.id
                    ).active = false;
                    return;
                }
            if (table == "shop_orders" && item.sent)
                if (
                    !confirm(
                        "Czy na pewno oznaczyć jako wysłane? Zostanie wysłane potwierdzenie na maila użytkownika!"
                    )
                ) {
                    this.block.table.find(
                        row => item.id == row.id
                    ).sent = false;
                    return;
                } else {
                    this.sendShippingConfirmation(item);
                }

            axios
                .put(`/api/${table}/edit`, item)
                .then(res => {
                    this.$emit("reloadFlag", true);
                    setTimeout(() => this.$emit("reloadFlag", false), 200);
                    this.$store.commit("setSnackbar", snackbarAlerts.edit);
                    if (table == "reservations" && item.active)
                        this.acceptReservation(item);
                })
                .catch(err => {
                    this.$store.commit("setSnackbar", snackbarAlerts.error);
                    console.log(err);
                });
        }
    }
};
</script>

<style scoped>
.form-link {
    text-decoration: none !important;
}
</style>
