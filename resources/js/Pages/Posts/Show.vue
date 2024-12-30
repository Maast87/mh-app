<script setup>
    import {Head, Link} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {computed, provide} from "vue";
    import Pagination from "@/Components/Pagination.vue";
    import {relativeDate} from "@/Utilities/date.js";
    import Comment from "@/Components/Comment.vue";

    const breadcrumbs = [
        { label: "home" },
        { label: "single post naam nog bepalen", href: "/posts" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps(['post', 'comments']);

    const formattedDate = computed(() => relativeDate(props.post.created_at));
</script>

<template>
    <Head :title="post.title" />

    <Layout>
        <h1 class="text-header_s">{{ post.title }}</h1>
        <p class="text-base ">{{ formattedDate }} ago by {{ post.user.name }}</p>

        <article class="mt-4">
            <pre class="whitespace-pre-wrap text-base font-sans">{{ post.body }}</pre>
        </article>

        <div class="mt-12">
            <h2 class="text-header_s">Comments</h2>
            <ul class="divide-y mt-4">
                <li v-for="comment in comments.data" :key="comment.id" class="px-2 py-4">
                    <Comment :comment="comment" />
                </li>
            </ul>

            <Pagination :meta="comments.meta" :only="['comments']" />
        </div>
    </Layout>

</template>
