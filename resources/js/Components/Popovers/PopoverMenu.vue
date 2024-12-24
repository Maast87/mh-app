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
                class="group inline-flex items-center rounded-lg transition ease-in-out duration-300 bg-none px-[25px] py-[10px] text-blue-700 text-button_text_s hover:bg-gray-300 hover:translate-y-[-2px] hover:shadow-mh_box_shadow hover:text-blue-800"
            >
                <span>{{ title }}</span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="var(--mh-blue-700)"
                    class="size-4 ml-2"
                >
                    <path
                        d="m19.5 8.25-7.5 7.5-7.5-7.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
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
                        <div class="bg-gray-300 p-4">
                            <div class="flow-root rounded-md px-2 py-2">
                                <span class="flex items-center">
                                    <span class="text-header_s">{{ sectionTitle }}</span>
                                </span>
                                <span class="block text-base">
                                    {{ sectionDescription }}
                                </span>
                            </div>
                        </div>
                        <div class="relative grid gap-8 bg-gray-100 p-7">
                            <!-- Links -->
                            <Link
                                v-for="item in menuItems"
                                :key="item.name"
                                :href="item.href"
                                :method="item.method"
                                class="group button-quinary"
                                :class="{'button-quinary-current' : $page.url === item.href}"
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
                                                'text-blue-700': $page.url !== item.href
                                            }"
                                        >
                                            {{ item.name }}
                                        </p>
                                        <div class="text-blue-700 transition ease-in-out duration-300 group-hover:text-gray-100 group-hover:translate-x-[3px]">
                                            &rarr;
                                        </div>
                                    </div>
                                    <p
                                        class="text-base text-blue-700 group-hover:text-gray-100"
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
                </PopoverPanel>
            </transition>
        </Popover>
    </div>
</template>
