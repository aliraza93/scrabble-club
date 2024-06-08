<template>
    <Head title="Leader Board" />
    <Main />
    <section class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h1
                    class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center"
                >
                    Leaderboard
                </h1>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li
                        v-for="(member, index) in topMembers"
                        :key="member.id"
                        class="flex justify-between items-center py-4 px-2"
                    >
                        <div class="flex items-center space-x-4">
                            <span
                                class="text-lg font-medium text-gray-900 dark:text-white"
                                >{{ index + 1 }}.</span
                            >
                            <span
                                class="text-lg font-medium text-gray-900 dark:text-white"
                            >
                                <a
                                    :href="`members/${member.id}`"
                                    class="text-blue-600 dark:text-blue-500 hover:underline"
                                    >{{ member.name }}</a
                                ></span
                            >
                        </div>
                        <span
                            class="text-lg font-semibold text-gray-900 dark:text-white"
                            >{{ member.averageScore.toFixed(2) }}</span
                        >
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import Main from "../Layout/Main.vue";

defineProps({
    topMembers: {
        type: Object,
        required: true,
    },
});
</script>

<style scoped>
.container {
    max-width: 800px;
}
</style>
