<script setup>
import {Head, router, useForm} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {computed, provide, ref} from "vue";
    import Pagination from "@/Components/Pagination.vue";
    import {relativeDate} from "@/Utilities/date.js";
    import Comment from "@/Components/Comment.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import Textarea from "@/Components/Textarea.vue";
    import InputError from "@/Components/InputError.vue";

    const breadcrumbs = [
        { label: "home" },
        { label: "single post naam nog bepalen", href: "/posts" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps(['post', 'comments']);

    const formattedDate = computed(() => relativeDate(props.post.created_at));

    const commentForm = useForm({
        body: '',
    });

    // Reactive variable to manage the button disabled state
    const isButtonDisabled = ref(false);

    const addComment = () => {
        isButtonDisabled.value = true;  // Disable the button before submitting the form

        commentForm.post(route('posts.comments.store', props.post.id), {
            preserveScroll: true,
            onSuccess: () => {
                commentForm.reset();
                isButtonDisabled.value = false;  // Re-enable the button after success
            },
        });
    };

    const deleteComment = (commentId) => router.delete(route('comments.destroy', { comment: commentId, page: props.comments.meta.current_page }), {
        preserveScroll: true,
    });

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

            <form @submit.prevent="addComment" v-if="$page.props.auth.user">
                <div>
                    <InputLabel for="body" class="sr-only">Comment</InputLabel>
                    <Textarea id="body" v-model="commentForm.body" rows="4" placeholder="er was eens..." class="mt-4" />
                    <InputError :message="commentForm.errors.body" />
                </div>
                <ButtonOne :disabled="isButtonDisabled" type="submit" class="mt-4" title="Add Comment" />
            </form>

            <ul class="divide-y mt-4">
                <li v-for="comment in comments.data" :key="comment.id" class="px-2 py-4">
                    <Comment @delete="deleteComment" :comment="comment" />
                </li>
            </ul>

            <Pagination :meta="comments.meta" :only="['comments']" />
        </div>
    </Layout>
</template>
