<script setup>
    import Nav from "@/Pages/Shared/Nav.vue";

</script>

<template>
    <section id="header" class="sticky top-0 py-2 bg-gray-100 drop-shadow-[0px_2px_1px_rgba(0,0,0,0.25)] transition ease-in-out duration-300 z-10">
        <Nav/>
    </section>
    <section id="main" class="bg-gray-200 h-screen">
        <div id="content" class="mx-auto flex max-w-7xl bg-gray-100">
            <slot />
        </div>
    </section>
</template>

<style scoped>

</style>
