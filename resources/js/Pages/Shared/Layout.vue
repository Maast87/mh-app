<script setup>
    import Nav from "@/Pages/Shared/Nav.vue";
    import Breadcrumb from "@/Pages/Shared/Breadcrumb.vue";
    import Footer from "@/Pages/Shared/Footer.vue";

</script>

<template>
    <section id="header" class="sticky top-0 py-2 bg-gray_100_blue_900 drop-shadow-[0px_2px_1px_rgba(0,0,0,0.25)] transition ease-in-out duration-300 z-10">
        <Nav />
    </section>
    <section id="main" class="bg-gray_200_blue_800 h-full pt-10">
        <div class="flex flex-col content-container">
            <div id="breadcrumb" class="flex p-2 bg-gray_100_blue_900 border border-gray-400 rounded-xl gap-x-4 mb-10">
                <Breadcrumb />
            </div>

            <div id="content" class="flex bg-gray_100_blue_900 rounded-xl">
                <slot />
            </div>

            <div class="pb-10">
                <Footer />
            </div>
        </div>
    </section>
</template>
