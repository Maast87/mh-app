<script setup>
    import {Head, Link} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide} from "vue";
    import Pagination from "@/Components/Pagination.vue";
    import {relativeDate} from "@/Utilities/date.js";
    import Pill from "@/Components/Pill.vue";

    const breadcrumbs = [
        { label: "home" },
        { label: "posts", href: "/posts" }
    ];
    provide('breadcrumbs', breadcrumbs);

    defineProps(['posts', 'topics', 'selectedTopic']);

    const formattedDate = (post) => relativeDate(post.created_at);
</script>

<template>
    <Head title="Posts" />

    <Layout>
        <div>
            <div v-if="selectedTopic">
                <p  class="text-header_s">
                    {{ selectedTopic.name }}
                </p>
                <p class="text-base">
                    {{ selectedTopic.description }}
                </p>
            </div>
            <p v-if="! selectedTopic" class="text-header_s">
                All posts
            </p>
        </div>

        <menu class="flex gap-x-2 mt-4 overflow-x-auto pb-2 pt-1">
            <li>
                <Pill
                    :href="route('posts.index')"
                    :filled="! selectedTopic"
                >
                    All posts
                </Pill>
            </li>
            <li v-for="topic in topics" :key="topic.id">
                <Pill
                    :href="route('posts.index', { topic: topic.slug })"
                    :filled="topic.id === selectedTopic?.id"
                >
                    {{ topic.name }}
                </Pill>
            </li>
        </menu>

        <ul class="divide-y">
            <li v-for="post in posts.data" :key="post.id" class="flex justify-between items-baseline flex-col md:flex-row">
                <Link :href="post.routes.show" class="group block px-2 py-4">
                    <span class="group-hover:text-red-700 font-bold text-header_s">{{ post.title }}</span>
                    <p class="text-base ">{{ formattedDate(post) }} ago by {{ post.user.name }}</p>
                </Link>
                <Pill :href="route('posts.index', { topic: post.topic.slug })">
                    {{ post.topic.name }}
                </Pill>
            </li>
        </ul>

        <Pagination :meta="posts.meta" />
    </Layout>

</template>

<style scoped>

</style>
