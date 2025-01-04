<script setup>
    import {relativeDate} from "@/Utilities/date.js";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import {Link, router} from "@inertiajs/vue3";

    const props = defineProps(['comment']);

    const emit = defineEmits(['delete', 'edit']);

    const deleteComment = () => router.delete(route('comments.destroy', { comment: props.comment.id, page: 2 }), {
        preserveScroll: true,
    });

</script>

<template>

    <div class="mt-1 prose prose-sm max-w-none" v-html="comment.html" />
    <p class="text-xs">By {{ comment.user.name }}, {{ relativeDate(comment.created_at) }} ago | <span>{{ comment.likes_count }} likes</span></p>
    <div class="flex justify-end gap-x-2 mt-4 empty:hidden">
        <div v-if="$page.props.auth.user">
            <Link v-if="comment.can.like" preserve-scroll :href="route('likes.store', ['comment', comment.id])" method="post" class="button-one">
                Like
            </Link>
            <Link v-if="! comment.can.like" preserve-scroll :href="route('likes.destroy', ['comment', comment.id])" method="delete" class="button-one">
                Unlike
            </Link>
        </div>
        <form v-if="comment.can?.update" @submit.prevent="$emit('edit', comment.id)">
            <ButtonOne title="Edit" />
        </form>
        <form v-if="comment.can?.delete" @submit.prevent="$emit('delete', comment.id)">
            <ButtonOne title="Verwijder" />
        </form>
    </div>
</template>
