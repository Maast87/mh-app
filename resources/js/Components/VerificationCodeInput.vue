<script setup>
    import { ref, watch, onMounted } from 'vue';

    const emit = defineEmits(['update:modelValue']);
    const props = defineProps({
        modelValue: String,
        autofocus: {
            type: Boolean,
            default: true
        }
    });

    const digits = ref(['', '', '', '', '', '']);
    const inputs = ref([]);

    onMounted(() => {
        if (props.autofocus && inputs.value[0]) {
            inputs.value[0].focus();
        }
    });

    // Watch for changes in individual digits and combine them
    watch(digits, (newDigits) => {
        const code = newDigits.join('');
        emit('update:modelValue', code);
    }, { deep: true });

    // Watch for external modelValue changes
    watch(() => props.modelValue, (newValue) => {
        if (!newValue) {
            digits.value = ['', '', '', '', '', ''];
            return;
        }
        const newDigits = newValue.split('').slice(0, 6);
        // Ensure array always has 6 elements
        digits.value = [...newDigits, ...Array(6 - newDigits.length).fill('')];
    }, { immediate: true });

    const focusNext = (index) => {
        if (index < 5 && digits.value[index] !== '') {
            inputs.value[index + 1].focus();
        }
    };

    const focusPrev = (index) => {
        if (index > 0) {
            inputs.value[index - 1].focus();
        }
    };

    const handleInput = (index, event) => {
        const value = event.target.value;
        // Only allow numbers
        const digit = value.replace(/\D/g, '').slice(-1);
        digits.value[index] = digit;
        
        if (digit !== '') {
            focusNext(index);
        }

        // If all digits are filled, emit the complete value
        if (digits.value.every(d => d !== '')) {
            emit('update:modelValue', digits.value.join(''));
        }
    };

    const handleKeydown = (index, event) => {
        if (event.key === 'Backspace' && digits.value[index] === '') {
            focusPrev(index);
        }
    };

    const handlePaste = (event) => {
        event.preventDefault();
        const pastedText = event.clipboardData.getData('text');
        const numbers = pastedText.replace(/\D/g, '').slice(0, 6);
        
        // Ensure array always has 6 elements
        digits.value = [...numbers.split(''), ...Array(6 - numbers.length).fill('')];
        
        // Focus the next empty input or the last input if all are filled
        const nextEmptyIndex = digits.value.findIndex(d => d === '');
        if (nextEmptyIndex === -1) {
            inputs.value[5].focus();
        } else {
            inputs.value[nextEmptyIndex].focus();
        }
    };
</script>

<template>
    <div class="flex gap-2 justify-center">
        <input
            v-for="i in 6"
            :key="i"
            type="text"
            :value="digits[i - 1]"
            @input="handleInput(i - 1, $event)"
            @keydown="handleKeydown(i - 1, $event)"
            @paste="handlePaste"
            :ref="el => inputs[i - 1] = el"
            maxlength="1"
            class="w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-blue_700_gray_100 focus:ring-blue_700_gray_100"
            :class="{ 'border-blue_700_gray_100': digits[i - 1] !== '' }"
            :autofocus="autofocus && i === 1"
        />
    </div>
</template> 