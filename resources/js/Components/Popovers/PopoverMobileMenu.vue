<script setup>
    import { ref, defineProps, defineEmits } from "vue";
    import { Link } from "@inertiajs/vue3";

    defineProps({
        isOpen: { type: Boolean, required: true },
    });

    const isProfileMenuOpen = ref(false);
    const isSupportMenuOpen = ref(false);

    const toggleProfileMenu = () => {
        isProfileMenuOpen.value = !isProfileMenuOpen.value;
    };

    const toggleSupportMenu = () => {
        isSupportMenuOpen.value = !isSupportMenuOpen.value;
    };
</script>

<template>
    <div class="flex items-center justify-between p-4">
        <p class="text-white">Hello</p>
        <button
            @click="$emit('close')"
            class="text-white"
        >
            Close menu
        </button>
    </div>
    <div id="mobile-menu-items">
        <!-- Profile Section -->
        <div>
            <button @click="toggleProfileMenu" class="text-white">Ondersteuning</button>
            <div v-if="isProfileMenuOpen" class="pl-4">
                <a href="" class="text-white block">Settings</a>
                <a href="" class="text-white block">Messages</a>
            </div>
        </div>

        <!-- Support Section -->
        <div>
            <button @click="toggleSupportMenu" class="text-white">Resultaten</button>
            <div v-if="isSupportMenuOpen" class="pl-4">
                <a href="" class="text-white block">Create ticket</a>
                <a href="" class="text-white block">Send email</a>
            </div>
        </div>

        <!-- Shop Section -->
        <a href="" class="text-white block">Shop</a>
    </div>
</template>
