<script setup>
    import {relativeDate} from "@/Utilities/date.js";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import {router} from "@inertiajs/vue3";

    const props = defineProps(['comment']);

    const emit = defineEmits(['delete']);

    const deleteComment = () => router.delete(route('comments.destroy', { comment: props.comment.id, page: 2 }), {
        preserveScroll: true,
    });

</script>

<template>
    <p class="text-base font-medium break-all">{{ comment.body }}</p>
    <p class="text-xs">By {{ comment.user.name }}, {{ relativeDate(comment.created_at) }} ago</p>
    <div class="mt-4 empty:hidden" v-if="comment.can?.delete">
        <form @submit.prevent="$emit('delete', comment.id)">
            <ButtonOne title="Verwijder" />
        </form>
    </div>
</template>
