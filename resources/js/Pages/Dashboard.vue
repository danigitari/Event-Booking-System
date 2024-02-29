<template>
    <div class="">
        <!-- Your dashboard content here -->
        <Navbar />
        <div class="w-full max-w-screen flex flex-wrap justify-center">
            <div
                class="max-w-sm bg-white rounded overflow-hidden shadow-lg shadow-gray-400 m-5 hover:shadow-xl w-[350px] md:w-[280px]"
                v-for="event in events"
            >
                <img
                    class="w-full h-[200px]"
                    src="https://storage.googleapis.com/m_tickets/assets/event_poster/thompson-falls-hike-and-adventure2024-02-10T14-27-01.183612.jpeg"
                    alt="event Image"
                />
                <div class="px-6 py-4">
                    <div class="mb-2">
                        <h2 class="text-xl font-bold text-gray-900 py-2">
                            <!-- {{ event.title}} -->
                            {{ event.name }}
                        </h2>
                        <h2 class="text-md font-bold text-gray-500 py-2">
                            <!-- {{ event.description }} -->
                            {{ event.description }}
                        </h2>

                        <h2 class="text-md text-gray-500 py-2">
                            <!-- {{ event.date }} -->
                            {{ event.date }}
                        </h2>

                        <v-dialog max-width="650">
                            <template
                                v-slot:activator="{ props: activatorProps }"
                            >
      

                                <div class="flex justify-end">
                                            <button
                                            v-bind="activatorProps"
                                                class="bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md mx-5"
                                     
                                            >Attend
                                            </button>
                                        </div>
                            </template>

                            <template v-slot:default="{ isActive }">
                                <v-card :title="event.name">
                                    <img
                                        class="w-full h-[200px]"
                                        src="https://storage.googleapis.com/m_tickets/assets/event_poster/thompson-falls-hike-and-adventure2024-02-10T14-27-01.183612.jpeg"
                                        alt="event Image"
                                    />

                                    <h2
                                        class="text-md font-bold text-gray-700 m-5 py-2"
                                    >
                                        <!-- {{ event.description }} -->
                                        {{ event.description }}
                                    </h2>
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
                                                    label="Email"
                                                    required
                                                    v-model="email"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-text-field
                                                    label="PhoneNumber"
                                                    required
                                                    v-model="phone"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="6">
                                                <v-select
                                                    :items="[
                                                        'vip-ticket ' + '=> ' + 'Ksh '+ event.vip_price,
                                                        'regular-ticket ' +  '=> ' + 'Ksh ' + event.regular_price,
                                                    ]"
                                                    label="Tickets"
                                                    required
                                                    v-model="ticketType"
                                                ></v-select>
                                            </v-col>
                                        </v-row>
                                    </v-container>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <div class="flex justify-end">
                                            <button
                                                class="bg-[#303690] py-2 px-3 text-white text-sm rounded-md shadow-md mx-5"
                                                @click="attendEvent(event.id)"
                                            >
                                                Book Ticket
                                            </button>
                                        </div>
                                    </v-card-actions>
                                </v-card>
                            </template>
                        </v-dialog>
  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <v-snackbar v-model="showAlert" 
            color="success" :timeout="2000">
        <template v-slot:actions>
            <v-btn color="blue" variant="text" @click="snackbar = false">
                Close
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
import { defineComponent } from "vue";
import Navbar from "./Navbar.vue";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

export default defineComponent({
    name: "Dashboard",
    components: {
        Navbar,
    },
    setup() {
        // Your setup logic here
        const events = ref(null);
        const router = useRouter();
        const showAlert = ref(false);
        const name = ref("");
        const email = ref("");
        const phone = ref("");
        const ticketType = ref("");
        const error = ref("");
        const message = ref("");

        onMounted(() => {
            getEvents();
        });

        const attendEvent = (eventId) => {
            axios
                .post(
                    "/api/buyTicket",
                    {
                        event_id: eventId,
                        name: name.value,
                        email: email.value,
                        phone: phone.value,
                        ticketType: ticketType.value,
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
                    events.value = response.data.events;
                    message.value = response.data.message;
                    showAlert.value = true;
                    getEvents();
                })
                .catch((error) => {
                    error.value = error.message;
                    console.log(error);
                });

            console.log("Attending event with id: ", eventId);
        };
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
                    events.value = response.data.events;
                })
                .catch((error) => {
                    console.log(error);
                });
        }

        return {
            events,
            attendEvent,
            getEvents,
            showAlert,
            name,
            email,
            phone,
            ticketType,
            error,

        };
    },
});
</script>

<style scoped></style>
