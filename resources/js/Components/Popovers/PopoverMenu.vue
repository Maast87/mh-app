<script setup>
    import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
    import { Link } from '@inertiajs/vue3';

    defineProps({
        title: String,
        sectionTitle: String,
        sectionDescription: String,
        menuItems: Array,
    });

</script>

<template>
    <div class="max-w-sm">
        <Popover class="relative">
            <!-- Popover Button -->
            <PopoverButton
                class="group inline-flex items-center rounded-lg transition ease-in-out duration-300 bg-none px-[25px] py-[10px] text-blue_700_gray_100 text-button_text_s hover:bg-gray-300 hover:translate-y-[-2px] hover:shadow-mh_box_shadow hover:text-blue-800"
            >
                <span>{{ title }}</span>
                <svg
                    class="ml-2"
                    width="15"
                    height="15"
                    fill="var(--mh-blue-700-gray-100)"
                    data-name="Content"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 128 128"
                >
                    <line x1="29.82" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                    <line x1="98.18" y1="46.91" x2="64" y2="81.09" style="fill: var(--mh-blue-700-gray-100); stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 5px;"/>
                </svg>
            </PopoverButton>

            <!-- Transition Animation -->
            <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100"
                leave-to-class="translate-y-1 opacity-0"
            >
                <!-- Popover Panel -->
                <PopoverPanel
                    class="absolute left-1/2 z-10 mt-3 w-screen max-w-sm -translate-x-1/2 transform px-4 sm:px-0"
                    v-slot="{ close }"
                >
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <div class="bg-gray_300_blue_900 p-4">
                            <div class="flow-root rounded-md px-2 py-2">
                                <span class="flex items-center">
                                    <span class="text-header_s text-blue_700_gray_100">{{ sectionTitle }}</span>
                                </span>
                                <span class="block text-base text-blue_700_gray_100">
                                    {{ sectionDescription }}
                                </span>
                            </div>
                        </div>
                        <div class="relative grid gap-8 bg-gray_100_blue_800 p-7">
                            <!-- Links -->
                            <Link
                                v-for="item in menuItems"
                                :key="item.name"
                                :href="item.href"
                                :method="item.method"
                                class="group button-five"
                                :class="{'button-five-current' : $page.url === item.href}"
                                @click="close"
                            >
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center bg-gray-300 sm:h-12 sm:w-12 rounded-md"
                                >
                                    <div v-html="item.icon"></div>
                                </div>
                                <div class="ml-4">
                                    <div class="flex flex-row items-center gap-x-1.5">
                                        <p
                                            class="text-base font-bold group-hover:gradient-text"
                                            :class="{
                                                'gradient-text': $page.url === item.href,
                                                'text-blue_700_gray_100': $page.url !== item.href
                                            }"
                                        >
                                            {{ item.name }}
                                        </p>
                                        <div class="text-blue_700_gray_100 transition ease-in-out duration-300 group-hover:text-gray_100_blue_800 group-hover:translate-x-[3px]">
                                            &rarr;
                                        </div>
                                    </div>
                                    <p
                                        class="text-base group-hover:text-gray_100_blue_800"
                                        :class="{
                                            'text-gray_100_blue_700': $page.url === item.href,
                                            'text-blue_700_gray_100': $page.url !== item.href
                                        }"
                                    >
                                        {{ item.description }}
                                    </p>
                                </div>
                            </Link>
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </div>
</template>
