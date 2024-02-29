<template>

        <Navbar />
        <div class="pt-5">
            <v-row class="flex justify-end p-5 mx-1">
                <v-dialog v-model="dialog" persistent width="720">
                    <template v-slot:activator="{ props }">
                        <button
                            class="bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md"
                            v-bind="props"
                        >
                            Add New Event
                        </button>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h6">Add New Event </span>
                        </v-card-title>
                        <hr />
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Name"
                                            v-model="name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            :items="description"
                                            label="Description"
                                            required
                                            v-model="description"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <input
                                            type="date"
                                            name=""
                                            id=""
                                            v-model="date"
                                        />
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Tickets"
                                            required
                                            v-model="max_attendees"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Location"
                                            required
                                            v-model="location"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Vip Ticket"
                                            required
                                            v-model="vip_price"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Regular Ticket"
                                            required
                                            v-model="regular_price"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions class="m-5">
                            <v-spacer></v-spacer>
                            <button
                                class="bg-red-600 py-2 px-4 text-white text-sm rounded-md shadow-md"
                                @click="dialog = false"
                            >
                                Close
                            </button>
                            <button
                                class="bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md ml-4"
                                @click="addNewEvent"
                            >
                                Save
                            </button>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </div>

        <div class="mx-5 bg-white shadow-lg rounded-md p-2">
            <EasyDataTable :headers="headers" :items="items" border-cell>
                <template #item-edit-operation="selectedItem">
                    <v-dialog v-model="editDialog" persistent width="720">
                        <template v-slot:activator="{ props }">
                            <div class="flex items-center justify-center">
                                <button
                                    class="rounded-full bg-blue-600 py-1 px-4 text-white text-sm shadow-md"
                                    @click="showEditModal(selectedItem)"
                                    v-bind="props"
                                >
                                    edit
                                </button>
                            </div>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h6">Edit Event </span>
                            </v-card-title>
                            <hr />
                            <v-card-text>
                                <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Name"
                                            v-model="name"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            :items="description"
                                            label="Description"
                                            required
                                            v-model="description"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <input
                                            type="date"
                                            name=""
                                            id=""
                                            v-model="date"
                                        />
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Tickets"
                                            required
                                            v-model="max_attendees"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Location"
                                            required
                                            v-model="location"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Vip Ticket"
                                            required
                                            v-model="vip_price"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field
                                            label="Regular Ticket"
                                            required
                                            v-model="regular_price"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                            </v-card-text>
                            <v-card-actions class="m-5">
                                <v-spacer></v-spacer>
                                <button
                                    class="bg-red-600 py-2 px-4 text-white text-sm rounded-md shadow-md"
                                    @click="editDialog = false"
                                >
                                    Close
                                </button>
                                <button
                                    class="bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md ml-4"
                                    @click="editEvent(selectedItem)"
                                >
                                    Save
                                </button>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </template>

                <template #item-delete-operation="selectedItem">
                    <div class="operation-wrapper">
                        <button
                            class="rounded-full bg-red-600 py-1 px-4 text-white text-sm shadow-md"
                            @click="showDeleteModal(selectedItem)"
                        >
                            delete
                        </button>
                    </div>
                </template>

            </EasyDataTable>
        </div>

</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import Navbar from "../Navbar.vue";

export default {
    components: {
        Navbar,
    },
    setup() {
        onMounted(() => {
            getEvents();
        });

        const dialog = ref(false);
        const editDialog = ref(false);
        const items = ref([]);
        const name = ref("");
        const description = ref("");
        const date = ref("");
        const max_attendees = ref("");
        const location = ref("");
        const vip_price = ref("");
        const regular_price = ref("");
        const item = ref({});
        const headers = ref([
            {
                text: "Name",
                align: "start",
                value: "name",
            },
            { text: "Description", value: "description" },
            { text: "Date", value: "date" },
            { text: "Max Attendees", value: "max_attendees" },
            { text: "Location", value: "location" },
            { text: "Vip Price", value: "vip_price" },
            { text: "Regular Price", value: "regular_price" },
            { text: "Edit", value: "edit-operation" },
            { text: "Delete", value: "delete-operation" },
        ]);
        function showDeleteModal(selectedItem) {

            deleteDialog.value = true;
            deleteEvent(selectedItem.id);
        }
               const deleteDialog = ref(false);
        function addNewEvent() {
            axios
                .post(
                    "/api/addEvent",
                    {
                        name: name.value,
                        description: description.value,
                        date: date.value,
                        max_attendees: max_attendees.value,
                        location: location.value,
                        vip_price: vip_price.value,
                        regular_price: regular_price.value,
                    },
                    {
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    }
                )
                .then((response) => {
                    console.log(response.data);
                    dialog.value = false;
                })
                .catch((error) => {
                    console.log(error);
                });
            getEvents();
        }
        function getEvents() {
            axios
                .get("/api/getEvents", {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        Authorization:
                            "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    items.value = response.data.events;
                })
                .catch((error) => {
                    console.log(error);
                });
        }

        function showEditModal(selectedItem) {
            item.value = selectedItem;
            editDialog.value = true;
            name.value = selectedItem.name;
            description.value = selectedItem.description;
            date.value = selectedItem.date;
            max_attendees.value = selectedItem.max_attendees;
            location.value = selectedItem.location;
            vip_price.value = selectedItem.vip_price;
            regular_price.value = selectedItem.regular_price;
        }
        function editEvent(selectedItem) {

            axios
                .post(
                    "/api/editEvent/",
                    {   id: selectedItem.id,
                        name:   name.value,
                        description: description.value,
                        date: date.value,
                        max_attendees: max_attendees.value,
                        location: location.value,
                        vip_price: vip_price.value,
                        regular_price: regular_price.value,
                    },
                    {
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    }
                )
                .then((response) => {
                    console.log(response.data);
                    editDialog.value = false;
                })
                .catch((error) => {
                    console.log(error);
                });
            getEvents();
        }
        function deleteEvent(a) {
            console.log(a);
            axios
                .post(
                    "/api/deleteEvent",
                    {
                        id: a,
                    },
                    {
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            Authorization:
                                "Bearer " + localStorage.getItem("token"),
                        },
                    }
                )
                .then((response) => {
                    console.log(response.data);
                    dialog.value = false;
                })
                .catch((error) => {
                    console.log(error);
                });
            getEvents();
        }
        return {
            dialog,
            editDialog,
            deleteDialog,
            items,
            item,
            headers,
            name,
            description,
            date,
            max_attendees,
            location,
            vip_price,
            regular_price,
            addNewEvent,
            showEditModal,
            editEvent,
            showDeleteModal,
            deleteEvent,
            getEvents,
        };
    },
};
</script>
