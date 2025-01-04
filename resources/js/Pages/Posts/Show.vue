<script setup>
    import { Head, router, useForm, Link } from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import { computed, provide, ref } from "vue";
    import Pagination from "@/Components/Pagination.vue";
    import { relativeDate } from "@/Utilities/date.js";
    import Comment from "@/Components/Comment.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import InputError from "@/Components/InputError.vue";
    import {useConfirm} from "@/Utilities/composables/useComfirm.js";
    import MarkdownEditor from "@/Components/MarkdownEditor.vue";
    import Pill from "@/Components/Pill.vue";
    import DefaultModal from "@/Components/Modals/DefaultModal.vue";

    const breadcrumbs = [
        { label: "home" },
        { label: "single post naam nog bepalen", href: "/posts" },
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps(['post', 'comments']);

    const formattedDate = computed(() => relativeDate(props.post.created_at));

    const commentForm = useForm({
        body: '',
    });

    const isModalVisible = ref(false);
    const modalMessage = ref("");

    const isButtonDisabled = ref(false);

    const commentTextAreaRef = ref(null);
    const commentIdBeingEdited = ref(null);
    const commentBeingEdited = computed(() => props.comments.data.find(comment => comment.id === commentIdBeingEdited.value));

    const editComment = (commentId) => {
        commentIdBeingEdited.value = commentId;
        commentForm.body = commentBeingEdited.value?.body;
        commentTextAreaRef.value?.focus();
    };

    const cancelEditComment = () => {
        commentIdBeingEdited.value = null;
        commentForm.reset();
    };

    const addComment = () => {
        isButtonDisabled.value = true;

        commentForm.post(route('posts.comments.store', props.post.id), {
            preserveScroll: true,
            onSuccess: () => {
                commentForm.reset();
                isButtonDisabled.value = false;
                modalMessage.value = "Je comment is geplaatst";
                isModalVisible.value = true;
            },
        });
    };

    const { confirmation } = useConfirm()

    const updateComment = async () => {
        if (! await confirmation('Bevestig deze actie', 'Weet je zeker dat je dit wil doen? Deze actie is definitief.')) {
            commentTextAreaRef.value?.focus();
            return;
        }

        commentForm.put(route('comments.update', {
            comment: commentIdBeingEdited.value,
            page: props.comments.meta.current_page
        }), {
            preserveScroll: true,
            onSuccess: () => {
                cancelEditComment();
                modalMessage.value = "Je comment is bijgewerkt";
                isModalVisible.value = true;
            },
        });
    };

    const deleteComment = async (commentId) => {
        if (! await confirmation('Bevestig deze actie', 'Weet je zeker dat je dit wil doen? Deze actie is definitief.')) {
            return; // if confirmation cancelled, return early. Otherwise, execute delete logic down below
        }

        router.delete(route('comments.destroy', {
            comment: commentId,
            page: props.comments.data.length > 1 ? props.comments.meta.current_page : Math.max(props.comments.meta.current_page - 1, 1)
        }), {
            preserveScroll: true,
            onSuccess: () => {
                modalMessage.value = "Je comment is verwijderd";
                isModalVisible.value = true;
            },
        });
    };

</script>

<template>
    <Head :title="post.title">
        <link rel="canonical" :href="post.routes.show" />
    </Head>

    <Layout>
        <div class="flex">
            <Pill :href="route('posts.index', {topics: post.topic.slug})">{{ post.topic.name }}</Pill>
        </div>

        <h1 class="text-header_s">{{ post.title }}</h1>
        <p class="text-base">{{ formattedDate }} ago by {{ post.user.name }}</p>

        <div class="mt-4">
            <p class="font-bold">Likes: {{ post.likes_count }}</p>

            <div v-if="$page.props.auth.user" class="mt-2">
                <Link v-if="post.can.like" :href="route('likes.store', ['post', post.id])" method="post" class="button-one">
                    Like
                </Link>
                <Link v-if="! post.can.like" :href="route('likes.destroy', ['post', post.id])" method="delete" class="button-one">
                    Unlike
                </Link>
            </div>
        </div>

        <article class="mt-4 prose prose-sm max-w-none" v-html="post.html" />

        <div class="mt-12">
            <h2 class="text-header_s">Comments</h2>

            <form v-if="$page.props.auth.user" @submit.prevent="() => commentIdBeingEdited ? updateComment() : addComment()">
                <div>
                    <InputLabel for="body" class="sr-only">Comment</InputLabel>
                    <MarkdownEditor ref="commentTextAreaRef" id="body" v-model="commentForm.body" placeholder="er was eens..." editorClass="!min-h-[160px]" />
                    <InputError :message="commentForm.errors.body" />
                </div>
                <div class="flex mt-4 gap-x-2">
                    <ButtonOne :disabled="isButtonDisabled" type="submit" v-text="commentBeingEdited ? 'Update comment' : 'Add comment'" />
                    <ButtonOne v-if="commentBeingEdited" @click="cancelEditComment" title="Cancel" />
                </div>
            </form>

            <ul class="divide-y mt-4">
                <li v-for="comment in comments.data" :key="comment.id" class="px-2 py-4">
                    <Comment @edit="editComment" @delete="deleteComment" :comment="comment" />
                </li>
            </ul>

            <Pagination :meta="comments.meta" :only="['comments']" />
        </div>
    </Layout>

    <!-- Modal -->
    <DefaultModal :show="isModalVisible" @close="isModalVisible = false">
        <template #content>
            <div class="p-4">
                <h3 class="text-lg font-medium">{{ modalMessage }}</h3>
            </div>
        </template>
    </DefaultModal>
</template>
