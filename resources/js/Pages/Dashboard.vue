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
                            Event {{ event.name }}
                        </h2>
                        <h2 class="text-md font-bold text-gray-500 py-2">
                            <!-- {{ event.description }} -->
                            Description {{ event.description }}
                        </h2>

                        <h2 class="text-md text-gray-500 py-2">
                            <!-- {{ event.date }} -->
                            Date of {{ event.date }}
                        </h2>
                        <div class="flex justify-end right-0">
                            <button
                                class="bg-[#303690] py-2 px-3 text-white text-sm rounded-md shadow-md mx-5"
                                @click="attendEvent(event.id)"
                            >
                                Attend
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        onMounted(() => {
            getEvents();
        });

        const attendEvent = (eventId) => {
          router.push(`/event/${eventId}`);
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
            getEvents
        };
    },
});
</script>

<style scoped></style>
