<script setup>
    import PopoverMenu from './PopoverMenu.vue';
    import { useMenuStore } from '../../stores/menuItems.js';

    const menuStore = useMenuStore();
</script>

<template>
    <PopoverMenu
        title="Ondersteuning"
        sectionTitle="Ondersteuning"
        sectionDescription="Hier komt de tekst"
        :menuItems="menuStore.ondersteuningMenuItems"
    />
</template>
