<script setup>
    import {ref} from "vue";
    import {Head, Link} from "@inertiajs/vue3";
    import PopoverMobileMenu from "../../Components/Popovers/PopoverMobileMenu.vue";
    import PopoverResultaten from "../../Components/Popovers/PopoverResultaten.vue";
    import PopoverOndersteuning from "../../Components/Popovers/PopoverOndersteuning.vue";
    import PopoverProfiel from "../../Components/Popovers/PopoverProfiel.vue";
    import {useTheme} from "../../../composables/useTheme";
    import DarkModeToggle from "@/Components/DarkModeToggle.vue";

    const {dark} = useTheme();

    const isMobileMenuOpen = ref(false);

    const toggleMobileMenu = () => {
        isMobileMenuOpen.value = !isMobileMenuOpen.value;
    };

    defineProps({
        canLogin: {type: Boolean},
        canRegister: {type: Boolean},
    });
</script>

<template>
    <Head title="Home"/>

    <header class="flex items-center">
        <nav class="flex content-container items-center justify-between gap-x-1" aria-label="Global">
            <!-- Logo -->
            <div id="nav-logo" class="flex max-w-48">
                <Link href="/" class="-m-1.5 p-1.5">
                    <span class="sr-only">Mental Hygiene logo</span>
                    <img
                        v-if="!dark"
                        id="logo-light-mode"
                        src="../../../images/mental-hygiene-beta-logo-light.svg"
                        alt="Mental Hygiene Logo Light Mode"
                        class="w-[calc(25%+8rem)]"
                    />
                    <img
                        v-if="dark"
                        id="logo-dark-mode"
                        src="../../../images/mental-hygiene-beta-logo-dark.svg"
                        alt="Mental Hygiene Logo Dark Mode"
                        class="w-[calc(25%+8rem)]"
                    />
                </Link>
            </div>

            <!-- Mobile Menu Trigger -->
            <div id="nav-mobile-menu-trigger" class="lg:hidden flex flex-row gap-x-1">
                <button
                    @click="toggleMobileMenu"
                    class="button-secondary hover:button-secondary-hover active:button-secondary-active">
                    Open menu
                </button>
            </div>

            <!-- Desktop Menu -->
            <div id="nav-desktop-menu" class="hidden lg:flex flex-row gap-x-1">
                <Link href="/me-learning">
                    <button class="button-secondary hover:button-secondary-hover active:button-secondary-active">
                        Me-learning
                    </button>
                </Link>
                <Link href="/ik-loop-vast">
                    <button class="button-secondary hover:button-secondary-hover active:button-secondary-active">
                        Ik loop vast
                    </button>
                </Link>
                <PopoverOndersteuning/>
                <PopoverResultaten/>
            </div>

            <!-- Desktop Profile Menu -->
            <div id="nav-desktop-profile-menu" class="hidden lg:flex lg:justify-end gap-x-1">
                <template v-if="$page.props.auth.user">
                    <PopoverProfiel />
                    <Link href="/word-lid" v-if="! $page.props.auth.user.subscribed">
                        <button class="button-senary hover:button-senary-hover">
                            <p class="drop-shadow-[0_2px_1px_rgba(0,0,0,0.4)]">Word lid</p>
                        </button>
                    </Link>
                    <DarkModeToggle />
                </template>

                <template v-else>
                    <DarkModeToggle />
                    <Link href="/login">
                        <button class="button-secondary hover:button-secondary-hover active:button-secondary-active">
                            Log in
                        </button>
                    </Link>
                    <Link href="/registreren">
                        <button class="button-senary hover:button-senary-hover group">
                            <p class="text-gray_100_blue_800 group-hover:button-senary-text group-hover:text-gray-100">Start gratis</p>
                        </button>
                    </Link>
                </template>
            </div>

            <!-- Mobile Menu -->
            <div id="nav-mobile-menu"
                 v-if="isMobileMenuOpen"
                 class="lg:hidden fixed inset-y-0 right-0 z-100 w-full h-screen overflow-y-auto bg-gray-100"
            >
                <PopoverMobileMenu
                    :isOpen="isMobileMenuOpen"
                    @close="toggleMobileMenu"
                />
            </div>
        </nav>
    </header>
</template>
