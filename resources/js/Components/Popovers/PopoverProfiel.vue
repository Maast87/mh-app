<script setup>
    import { useMenuStore } from '../../stores/menuItems.js';
    import PopoverMenu from './PopoverMenu.vue';

    const menuStore = useMenuStore();

</script>

<template>
    <PopoverMenu
        title="Profiel"
        sectionTitle="Profielmenu"
        sectionDescription="Beheer je profiel"
        :menuItems="menuStore.profielMenuItems"
    />
</template>
