<script setup>
    import {relativeDate} from "@/Utilities/date.js";

    defineProps(['comment']);

</script>

<template>
    <span class="text-base font-medium">{{ comment.body }}</span>
    <p class="text-xs">By {{ comment.user.name }}, {{ relativeDate(comment.created_at) }} ago</p>
</template>
