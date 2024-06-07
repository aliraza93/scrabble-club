<template>
    <Head title="Member Profile" />
    <Main />
    <!-- Start block -->
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div
            class="mx-auto max-w-screen-xl px-4 lg:px-12 grid grid-cols-1 sm:grid-cols-2 gap-4"
        >
            <!-- Left Card -->
            <div
                class="bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Member profile
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Details and information about the member.
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div v-if="member">
                            <div v-for="(value, key) in member" :key="key">
                                <div
                                    v-if="
                                        key !== 'id' &&
                                        key !== 'created_at' &&
                                        key !== 'updated_at'
                                    "
                                    :class="{
                                        'bg-gray-50': isEven($index),
                                        'bg-white': !isEven($index),
                                    }"
                                    class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                                >
                                    <dt
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        {{ key }}
                                    </dt>
                                    <dd
                                        v-if="key === 'played_at'"
                                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                    >
                                        {{
                                            new Date(value).toLocaleDateString()
                                        }}
                                    </dd>
                                    <dd
                                        v-else
                                        class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                                    >
                                        {{ value }}
                                    </dd>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p>Loading...</p>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Right Card -->
            <div
                class="bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Gaming Stats
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Player's gaming performance.
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Average Score
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 flex items-center space-x-2"
                            >
                                <div>
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
                                </div>
                                <div>{{ averageScore }}</div>
                            </dd>
                        </div>
                        <div
                            class="px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Highest Score
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 flex items-center space-x-2"
                            >
                                <div>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-green-500"
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
                                </div>
                                <div>{{ highestScore }}</div>
                            </dd>
                        </div>

                        <div
                            class="px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Date of Highest Score
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                                {{
                                    highestScoreDate
                                        ? new Date(
                                              highestScoreDate
                                          ).toLocaleDateString()
                                        : "N/A"
                                }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Below Cards -->
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12 mt-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        Recent Games
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Game
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Score
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Played At
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Loop through recentGames data and display each game -->
                            <tr
                                v-for="(game, index) in recentGames"
                                :key="index"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ game.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="flex items-center text-sm text-gray-900"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-yellow-500 mr-1 mt-[-2px]"
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
                                        {{ game.pivot.score }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{
                                            new Date(
                                                game.played_at
                                            ).toLocaleDateString()
                                        }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";
import Main from "../../Layout/Main.vue";

defineProps({
    member: {
        type: Object,
        required: true,
    },
    averageScore: {
        type: Number,
        required: true,
    },
    highestScore: {
        type: Number,
        required: true,
    },
    highestScoreDate: {
        type: String,
        default: "",
    },
    recentGames: {
        type: Object,
        required: true,
    },
});

const isEven = (index) => index % 2 === 0;
</script>
