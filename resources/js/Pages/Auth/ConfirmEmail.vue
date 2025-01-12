<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import VerificationCodeInput from '@/Components/VerificationCodeInput.vue';
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import { Head, useForm } from '@inertiajs/vue3';
    import { provide, watch, ref } from "vue";

    const breadcrumbs = [
            { label: "home", href: "/" },
            { label: "registreren (e-mailadres bevestigen)" }
        ];
    provide('breadcrumbs', breadcrumbs);

    const isSubmitting = ref(false);
    const form = useForm({
        code: '',
    });

    const submit = () => {
        if (isSubmitting.value) return;
        isSubmitting.value = true;
        setTimeout(() => {
            form.post(route('verification.verify'));
        }, 450);
    };

    watch(() => form.code, (newCode) => {
        if (newCode.length === 6) {
            submit();
        }
    });

    // Reset submission state when form processing state changes
    watch(() => form.processing, (isProcessing) => {
        if (!isProcessing) {
            isSubmitting.value = false;
        }
    });
</script>

<template>
    <Layout>
        <Head title="Verify Email" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-3">
                <h1 class="text-header_xl text-blue_700_gray_100 text-center">
                    <span class="gradient-text">Bevestig</span> je e-mailadres
                </h1>
                <p class="text-base text-blue_700_gray_100 text-center">
                    We hebben een code naar je e-mailadres gestuurd.<br>
                    Vul deze code hieronder in om je e-mailadres te bevestigen.
                </p>
            </div>

            <GradientElement class="flex flex-col gap-y-3 lg:w-1/2">
                <GradientWhiteElement>
                    <form @submit.prevent="submit">
                        <div class="flex flex-col gap-y-6">
                            <div class="flex flex-col items-center justify-center gap-y-2">
                                <InputLabel for="code" value="Verificatiecode" />
                                <div class="mt-1">
                                    <VerificationCodeInput
                                        v-model="form.code"
                                        autofocus
                                    />
                                </div>
                                <InputError class="mt-2" :message="form.errors.code" />
                            </div>

                            <div class="flex flex-col items-center justify-center gap-y-2">
                                <ButtonOne 
                                    title="Bevestig e-mailadres" 
                                    :allowSpinner="true"
                                    :disableAfterClick="true"
                                    :disabled="isSubmitting"
                                    :processing="isSubmitting"
                                />
                            </div>
                        </div>
                    </form>
                </GradientWhiteElement>
            </GradientElement>
        </div>
    </Layout>
</template>
