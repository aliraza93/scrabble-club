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
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Rank
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Name
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Total Games
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                            >
                                Average Score
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <tr
                            v-for="(member, index) in topMembers"
                            :key="member.id"
                        >
                            <td
                                class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900 dark:text-white"
                            >
                                {{ index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <a
                                        :href="`members/${member.id}`"
                                        class="text-blue-600 dark:text-blue-500 hover:underline"
                                        >{{ member.name }}</a
                                    >
                                </div>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap flex items-center space-x-2"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-gray-500 dark:text-gray-400"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M17.5 10a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0zM10 3a7 7 0 0 1 5.656 11.313l-5.295 5.294a.5.5 0 0 1-.707 0l-5.294-5.294A7 7 0 0 1 10 3z"
                                    />
                                </svg>
                                <span
                                    class="text-lg font-semibold text-gray-900 dark:text-white"
                                    >{{ member.total_games }}</span
                                >
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-lg font-semibold text-gray-900 dark:text-white"
                            >
                                <div class="flex items-center space-x-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-yellow-500"
                                        style="margin-top: -6px"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 20H3V10h18v10z"
                                        />
                                    </svg>
                                    <span
                                        class="text-lg font-semibold text-gray-900 dark:text-white"
                                        >{{
                                            parseFloat(
                                                member.average_score
                                            ).toFixed(2)
                                        }}</span
                                    >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
