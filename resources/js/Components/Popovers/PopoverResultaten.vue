<script setup>
    import { useMenuStore } from '../../stores/menuItems.js';
    import PopoverMenu from './PopoverMenu.vue';

    const menuStore = useMenuStore();
</script>

<template>
    <PopoverMenu
        title="Resultaten"
        sectionTitle="Resultaten"
        sectionDescription="Hier komt de tekst"
        :menuItems="menuStore.resultatenMenuItems"
    />
</template>
