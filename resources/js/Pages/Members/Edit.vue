<template>
    <Head title="Update Member" />
    <Main />
    <!-- Start block -->
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h1
                class="text-xl sm:text-xl font-bold text-gray-800 dark:text-white"
            >
                Update member
            </h1>

            <div
                class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert"
                v-if="successMessage"
            >
                <span class="font-medium">Success alert!</span>
                {{ successMessage }}
            </div>

            <form class="max-w-sm mt-4" action="#" @submit.prevent="updateMember">
                <div class="mb-5">
                    <label
                        for="name-success"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Name</label
                    >
                    <input
                        type="text"
                        id="name-success"
                        v-model="name"
                        aria-describedby="helper-text-explanation"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':
                                errors.name,
                            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500':
                                !errors.name,
                        }"
                        placeholder="Jake"
                    />
                    <p
                        v-if="errors?.name"
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                    >
                        <span class="font-medium">Oops!</span>
                        {{ errors.name[0] }}
                    </p>
                </div>
                <div class="mb-5">
                    <label
                        for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Email</label
                    >
                    <input
                        type="email"
                        id="email"
                        v-model="email"
                        aria-describedby="helper-text-explanation"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':
                                errors.email,
                            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500':
                                !errors.email,
                        }"
                        placeholder="Jake@gmail.com"
                    />
                    <p
                        v-if="errors?.email"
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                    >
                        <span class="font-medium">Oops!</span>
                        {{ errors.email[0] }}
                    </p>
                </div>
                <div class="mb-5">
                    <label
                        for="phone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Phone</label
                    >
                    <input
                        type="number"
                        placeholder="678687876"
                        id="phone"
                        v-model="phone"
                        aria-describedby="helper-text-explanation"
                        :class="{
                            'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':
                                errors.phone,
                            'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500':
                                !errors.phone,
                        }"
                    />
                    <p
                        v-if="errors.phone"
                        class="mt-2 text-sm text-red-600 dark:text-red-500"
                    >
                        <span class="font-medium">Oops!</span>
                        {{ errors.phone[0] }}
                    </p>
                </div>
                <button
                    :disabled="isLoading"
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
                >
                    <template v-if="isLoading">
                        <svg
                            aria-hidden="true"
                            role="status"
                            class="inline w-4 h-4 me-3 text-white animate-spin"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB"
                            />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor"
                            />
                        </svg>
                        Saving...
                    </template>
                    <template v-else> Update Member </template>
                </button>
            </form>
        </div>
    </section>
</template>

<script setup>
import { defineProps, ref, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import Main from "../../Layout/Main.vue";

const props = defineProps({
    member: {
        type: Object,
        required: true,
    },
});

const name = ref(props.member.name);
const email = ref(props.member.email);
const phone = ref(props.member.phone);

const errors = ref({});

const isLoading = ref(false);
const disabled = ref(false);

const successMessage = ref("");

const updateMember = async () => {
    isLoading.value = true;
    const formData = {
        name: name.value,
        email: email.value,
        phone: phone.value,
    };

    try {
        const response = await axios.put(`/members/${props.member.id}`, formData);

        // Simulate a delay to mimic a server request
        await new Promise((resolve) => setTimeout(resolve, 2000));

        // Reset form fields after successful submission
        name.value = "";
        email.value = "";
        phone.value = "";

        // Clear errors after successful submission
        errors.value = {};

        if (response.status === 200) {
            successMessage.value = "Member updated successfully!";
            setTimeout(() => {
                location.href = "/members";
            }, 1000);
        }
    } catch (err) {
        if (err.response && err.response.status === 422) {
            errors.value = err.response.data.errors;
        } else {
            console.error("An error occurred:", err.message);
        }
    } finally {
        isLoading.value = false;
    }
};
</script>
