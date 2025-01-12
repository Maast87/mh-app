<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message" class="flex gap-x-3 mt-2 rounded-lg bg-red-200 p-2 items-center">
        <div class="w-10 h-10">
            <svg 
                id="uuid-5e00ec1d-c691-43cc-a035-8f7535066b85" 
                data-name="Content" 
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 128 128"
            >
            <path d="M60.97,21.37L17.23,97.14c-1.35,2.33.34,5.24,3.03,5.24h87.49c2.69,0,4.37-2.91,3.03-5.24L67.03,21.37c-1.35-2.33-4.71-2.33-6.05,0Z" style="fill: none; stroke: var(--mh-gray-100); stroke-miterlimit: 10; stroke-width: 4.5px;"/>
                <line x1="64" y1="46.5" x2="64" y2="78.5" style="fill: none; stroke: var(--mh-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                <circle cx="64" cy="86" r=".5" style="fill: none; stroke: var(--mh-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-100">{{ message }}</p>
        </div>
    </div>
</template>
