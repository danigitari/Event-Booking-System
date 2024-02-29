<template>
    <header class="flex w-full justify-between shadow-md bg-white">
        <div class="flex justify-between w-full p-5">
            <div class="flex mx-10">
                <p class="text-xl">Event Booking System</p>
            </div>
            <div class="flex mx-10">
                <button
                    class="bg-[#303690] py-2 px-4 text-white text-sm rounded-md shadow-md ml-4"
                    @click="Logout"
                >
                    Logout
                </button>
            </div>
        </div>
    </header>
</template>

<script>
import { ref } from "vue";
import { logout } from "../api/services.js";
import router from "../router";

export default {
    setup() {
        const menuItems = ref([
            { id: 1, label: "Home", url: "/" },
            { id: 2, label: "About", url: "/about" },
            { id: 3, label: "Contact", url: "/contact" },
        ]);

        const Logout = async () => {
            await logout();

            localStorage.removeItem("token");
            router.push("/");
        };

        return {
            menuItems,
            Logout,
        };
    },
};
</script>

<style scoped>
nav {
    background-color: #f0f0f0;
    padding: 10px;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

li {
    display: inline-block;
    margin-right: 10px;
}

a {
    text-decoration: none;
    color: #333;
}
</style>
