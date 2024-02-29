<template>
    <div
        class="flex flex-col items-center justify-center bg-gray-200 h-[100vh]"
    >
        <p class="text-blue-500 text-3xl mb-5 font-bold">REGISTER</p>
        <p class="text-red-500 text-md mb-5 italic" v-if="error">
            invalid credentials
        </p>

        <div class="w-full max-w-sm">
            <form
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                @submit.prevent="handleRegister"
            >
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name"
                        type="text"
                        placeholder="Username"
                        v-model="formData.name"
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="username"
                    >
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username"
                        type="email"
                        placeholder="Username"
                        v-model="formData.email"
                    />
                </div>
                <div class="mb-6">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="password"
                    >
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password"
                        type="password"
                        placeholder="password"
                        v-model="formData.password"
                    />
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Register
                    </button>

                    <a
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        @click="gotToLogin()"
                    >
                       Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { reactive, ref } from "vue";
import { register } from "../api/services.js";

import { useRouter } from "vue-router";
export default {
    name: "Register",

    setup() {
        const router = useRouter();
        const formData = reactive({
            name: "",
            email: "",
            password: "",
        });
        const error = ref(false);
        const handleRegister = async () => {
            const res = await register(formData);
            console.log();
            if (res.response) {
                if (res.response.status === 401) {
                    error.value = true;
                }
            }
            if (!res.data.role) {
                error.value = true;
                router.push("/");
            }

            if (res.status === 200) {
                if (res.data.role[0] === "admin") {
                    localStorage.setItem("token", res.data.token);
                    router.push("/admin-dashboard");
                } else {
                    localStorage.setItem("token", res.data.token);
                    router.push("/dashboard");
                }
            }
        };

        return {
            formData,
            handleRegister,
            error,
            gotToLogin: () => {
                router.push("/"); }
        };
    },
};
</script>
