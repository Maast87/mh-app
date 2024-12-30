<script setup>
    import {Head, Link} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide} from "vue";
    import Pagination from "@/Components/Pagination.vue";
    import {formatDistance, parseISO} from "date-fns";
    import {relativeDate} from "@/Utilities/date.js";

    const breadcrumbs = [
        { label: "home" },
        { label: "posts", href: "/posts" }
    ];
    provide('breadcrumbs', breadcrumbs);

    defineProps(['posts']);

    const formattedDate = (post) => relativeDate(post.created_at);
</script>

<template>
    <Head title="Posts" />

    <Layout>
        <p>
            Posts
        </p>

        <ul class="divide-y">
            <li v-for="post in posts.data" :key="post.id">
                <Link :href="route('posts.show', post.id)" class="group block px-2 py-4">
                    <span class="group-hover:text-red-700 font-bold text-header_s">{{ post.title }}</span>
                    <p class="text-base ">{{ formattedDate(post) }} ago by {{ post.user.name }}</p>
                </Link>
            </li>
        </ul>

        <Pagination :meta="posts.meta" />
    </Layout>

</template>

<style scoped>

</style>
