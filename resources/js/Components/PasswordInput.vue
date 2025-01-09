<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        modelValue: String,
        id: String,
        name: String,
        placeholder: String,
        required: {
            type: Boolean,
            default: false
        },
        autocomplete: String,
    });

    const emit = defineEmits(['update:modelValue']);

    const showPassword = ref(false);

    const togglePassword = () => {
        showPassword.value = !showPassword.value;
    };
</script>

<template>
    <div class="flex gap-x-3">
        <div class="flex-1">
            <input
                :type="showPassword ? 'text' : 'password'"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                :id="id"
                :name="name"
                :required="required"
                :autocomplete="autocomplete"
                class="input-one w-full rounded-lg"
            />
        </div>
        <div>
            <button
                tabindex="-1"
                type="button"
                @click="togglePassword"
                class="flex items-center justify-center w-[42px] h-[42px] p-1.5 bg-gray-300 rounded-lg hover:bg-gray-400 hover:translate-y-[-2px] mh-transition hover:shadow-mh_box_shadow active:translate-y-[0px] active:shadow-mh_box_shadow_off"
            >
                <svg    
                    v-if="showPassword"
                    id="uuid-ff46c186-cc4d-4bf2-8d37-99991839ccd5" 
                    data-name="Content" 
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 128 128"
                >
                    <g>
                        <path d="M122.27,64s-26.09,33.7-58.27,33.7c-32.18,0-58.27-33.7-58.27-33.7,0,0,26.09-33.7,58.27-33.7,32.18,0,58.27,33.7,58.27,33.7Z" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                        <circle cx="64" cy="64" r="17.5" style="fill: var(--mh-blue-700);"/>
                    </g>
                    <rect x="12.55" y="58.68" width="102.91" height="6.73" rx="3.37" ry="3.37" transform="translate(85.74 -24.4) rotate(60)" style="stroke: var(--mh-gray-300); stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;"/>
                </svg>
                <svg 
                    v-if="!showPassword"
                    id="uuid-4ef7dce7-5200-468e-bdce-cbf309176742" 
                    data-name="Content" 
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 128 128"
                >
                    <path d="M122.27,64s-26.09,33.7-58.27,33.7c-32.18,0-58.27-33.7-58.27-33.7,0,0,26.09-33.7,58.27-33.7,32.18,0,58.27,33.7,58.27,33.7Z" style="fill: none; stroke: var(--mh-blue-700); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                    <circle cx="64" cy="64" r="17.5" style="fill: var(--mh-blue-700);"/>
                </svg>
            </button>
        </div>
    </div>
</template> 