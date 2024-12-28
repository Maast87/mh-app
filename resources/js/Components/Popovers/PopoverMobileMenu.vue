<script setup>
    import { ref, defineProps, defineEmits } from "vue";
    import { Link } from "@inertiajs/vue3";
    import { useMenuStore } from '../../stores/menuItems.js';
    import {useTheme} from "../../../composables/useTheme";

    defineProps({
        isOpen: { type: Boolean, required: true },
    });

    const {dark} = useTheme();

    const menuStore = useMenuStore();
    const profielMenuItems = menuStore.profielMenuItems;
    const ondersteuningMenuItems = menuStore.ondersteuningMenuItems;
    const resultatenMenuItems = menuStore.resultatenMenuItems;

    const isProfielMenuOpen = ref(false);
    const isOndersteuningMenuOpen = ref(false);
    const isResultatenMenuOpen = ref(false);

    const toggleProfielMenu = () => {
        isProfielMenuOpen.value = !isProfielMenuOpen.value;
    };
    const toggleOndersteuningMenu = () => {
        isOndersteuningMenuOpen.value = !isOndersteuningMenuOpen.value;
    };
    const toggleResultatenMenu = () => {
        isResultatenMenuOpen.value = !isResultatenMenuOpen.value;
    };
</script>

<template>
    <div class="flex flex-col p-4">
        <div class="flex items-center justify-between mb-5 pb-5 border-0 border-b border-blue-700">
            <Link
                href="/home"
                class="-m-1.5 p-1.5"
                @click="$emit('close')"
            >
                <span class="sr-only">Mental Hygiene logo</span>
                <img
                    v-if="!dark"
                    id="logo-light-mode"
                    src="../../../images/mental-hygiene-beta-logo-light.svg"
                    alt="Mental Hygiene Logo Light Mode"
                    class="w-[calc(15%+8rem)]"
                />
                <img
                    v-if="dark"
                    id="logo-dark-mode"
                    src="../../../images/mental-hygiene-beta-logo-dark.svg"
                    alt="Mental Hygiene Logo Dark Mode"
                    class="w-[calc(15%+8rem)]"
                />
            </Link>
            <button
                @click="$emit('close')"
            >
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center bg-gray-300 sm:h-12 sm:w-12 rounded-md"
                >
                    <div>
                        <svg
                            width="28"
                            height="28"
                            id="uuid-11c75908-226c-48b9-bcea-78d8c4a6282d"
                            data-name="Content"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 128 128"
                        >
                            <line x1="96.88" y1="96.88" x2="31.12" y2="31.12" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            <line x1="96.88" y1="31.12" x2="31.12" y2="96.88" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                        </svg>
                    </div>
                </div>
            </button>
        </div>
        <div id="mobile-menu-items" class="flex flex-col gap-y-5">
            <!-- Profiel -->
            <div>
                <button
                    @click="toggleProfielMenu"
                    class="button-secondary bg-gray-300 font-bold"
                >
                    <div class="flex items-center justify-between gap-x-1">
                        <p>
                            Profiel
                        </p>
                        <div>
                            <svg
                                v-if="!isProfielMenuOpen"
                                class="ml-2"
                                width="20"
                                height="20"
                                fill="var(--mh-blue-700-gray-100)"
                                data-name="Content"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 128 128"
                            >
                                <line x1="29.82" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                <line x1="98.18" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            </svg>

                            <svg
                                v-if="isProfielMenuOpen"
                                class="ml-2"
                                width="20"
                                height="20"
                                fill="var(--mh-blue-700-gray-100)"
                                data-name="Content"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 128 128"
                            >

                                <line x1="98.18" y1="81.09" x2="64" y2="46.91" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                <line x1="29.82" y1="81.09" x2="64" y2="46.91" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            </svg>
                        </div>
                    </div>
                </button>
                <div v-if="isProfielMenuOpen" class="flex flex-col gap-y-5 pl-4 pt-5">
                    <Link
                        v-for="item in profielMenuItems"
                        :key="item.name"
                        :href="item.href"
                        :method="item.method"
                        class="group button-dropdown"
                        :class="{'button-dropdown-current' : $page.url === item.href}"
                        @click="$emit('close')"
                    >
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center bg-gray-300 sm:h-12 sm:w-12 rounded-md"
                        >
                            <div v-html="item.icon"></div>
                        </div>
                        <div class="ml-4">
                            <div class="flex flex-row items-center gap-x-1.5">
                                <p
                                    class="text-base font-semibold"
                                    :class="{
                                        'gradient-text': $page.url === item.href,
                                        'text-blue-700': $page.url !== item.href
                                    }"
                                >
                                    {{ item.name }}
                                </p>
                                <div class="text-blue-700">
                                    &rarr;
                                </div>
                            </div>
                            <p
                                class="text-base text-blue-700"
                                :class="{
                                    'text-gray-100': $page.url === item.href,
                                    'text-blue-700': $page.url !== item.href
                                }"
                            >
                                {{ item.description }}
                            </p>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- Me-learning en ik loop vast -->
            <div class="flex flex-col gap-y-5">
                <Link
                    href="/me-learning"
                    @click="$emit('close')"
                >
                    <button class="button-secondary bg-gray-300 font-bold text-blue-800">
                        Me-learning
                    </button>
                </Link>
                <Link
                    href="/ik-loop-vast"
                    @click="$emit('close')"
                >
                    <button class="button-secondary bg-gray-300 font-bold text-blue-800">
                        Ik loop vast
                    </button>
                </Link>
            </div>

            <!-- Ondersteuning -->
            <div>
                <button
                    @click="toggleOndersteuningMenu"
                    class="button-secondary bg-gray-300 font-bold"
                >
                    <div class="flex items-center justify-between gap-x-1">
                        <p>
                            Ondersteuning
                        </p>
                        <div>
                            <svg
                                v-if="!isOndersteuningMenuOpen"
                                class="ml-2"
                                width="20"
                                height="20"
                                fill="var(--mh-blue-700-gray-100)"
                                data-name="Content"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 128 128"
                            >
                                <line x1="29.82" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                <line x1="98.18" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            </svg>

                            <svg
                                v-if="isOndersteuningMenuOpen"
                                class="ml-2"
                                width="20"
                                height="20"
                                fill="var(--mh-blue-700-gray-100)"
                                data-name="Content"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 128 128"
                            >

                                <line x1="98.18" y1="81.09" x2="64" y2="46.91" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                <line x1="29.82" y1="81.09" x2="64" y2="46.91" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            </svg>
                        </div>
                    </div>
                </button>
                <div v-if="isOndersteuningMenuOpen" class="flex flex-col gap-y-5 pl-4 pt-5">
                    <Link
                        v-for="item in ondersteuningMenuItems"
                        :key="item.name"
                        :href="item.href"
                        :method="item.method"
                        class="group button-dropdown"
                        :class="{'button-dropdown-current' : $page.url === item.href}"
                        @click="$emit('close')"
                    >
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center bg-gray-300 sm:h-12 sm:w-12 rounded-md"
                        >
                            <div v-html="item.icon"></div>
                        </div>
                        <div class="ml-4">
                            <div class="flex flex-row items-center gap-x-1.5">
                                <p
                                    class="text-base font-semibold"
                                    :class="{
                                        'gradient-text': $page.url === item.href,
                                        'text-blue-700': $page.url !== item.href
                                    }"
                                >
                                    {{ item.name }}
                                </p>
                                <div class="text-blue-700">
                                    &rarr;
                                </div>
                            </div>
                            <p
                                class="text-base text-blue-700"
                                :class="{
                                    'text-gray-100': $page.url === item.href,
                                    'text-blue-700': $page.url !== item.href
                                }"
                            >
                                {{ item.description }}
                            </p>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- Resultaten -->
            <div>
                <button
                    @click="toggleResultatenMenu"
                    class="button-secondary bg-gray-300 font-bold"
                >
                    <div class="flex items-center justify-between gap-x-1">
                        <p>
                            Resultaten
                        </p>
                        <div>
                            <svg
                                v-if="!isResultatenMenuOpen"
                                class="ml-2"
                                width="20"
                                height="20"
                                fill="var(--mh-blue-700-gray-100)"
                                data-name="Content"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 128 128"
                            >
                                <line x1="29.82" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                <line x1="98.18" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            </svg>

                            <svg
                                v-if="isResultatenMenuOpen"
                                class="ml-2"
                                width="20"
                                height="20"
                                fill="var(--mh-blue-700-gray-100)"
                                data-name="Content"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 128 128"
                            >

                                <line x1="98.18" y1="81.09" x2="64" y2="46.91" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                                <line x1="29.82" y1="81.09" x2="64" y2="46.91" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                            </svg>
                        </div>
                    </div>
                </button>
                <div v-if="isResultatenMenuOpen" class="flex flex-col gap-y-5 pl-4 pt-5">
                    <Link
                        v-for="item in resultatenMenuItems"
                        :key="item.name"
                        :href="item.href"
                        :method="item.method"
                        class="group button-dropdown"
                        :class="{'button-dropdown-current' : $page.url === item.href}"
                        @click="$emit('close')"
                    >
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center bg-gray-300 sm:h-12 sm:w-12 rounded-md"
                        >
                            <div v-html="item.icon"></div>
                        </div>
                        <div class="ml-4">
                            <div class="flex flex-row items-center gap-x-1.5">
                                <p
                                    class="text-base font-semibold"
                                    :class="{
                                        'gradient-text': $page.url === item.href,
                                        'text-blue-700': $page.url !== item.href
                                    }"
                                >
                                    {{ item.name }}
                                </p>
                                <div class="text-blue-700">
                                    &rarr;
                                </div>
                            </div>
                            <p
                                class="text-base text-blue-700"
                                :class="{
                                    'text-gray-100': $page.url === item.href,
                                    'text-blue-700': $page.url !== item.href
                                }"
                            >
                                {{ item.description }}
                            </p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
