<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import VerificationCodeInput from '@/Components/VerificationCodeInput.vue';
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import { Head, useForm, Link } from '@inertiajs/vue3';
    import { provide, watch, ref, nextTick } from "vue";
    import DefaultModal from "@/Components/Modals/DefaultModal.vue";

    const breadcrumbs = [
            { label: "home", href: "/" },
            { label: "registreren (e-mailadres bevestigen)" }
        ];
    provide('breadcrumbs', breadcrumbs);

    const isModalVisible = ref(false);
    const codeInput = ref(null);

    const openModal = () => {
        isModalVisible.value = true;
    };

    const closeModal = () => {
        isModalVisible.value = false;
        // reload to automatically focus on the input
        setTimeout(() => {
            window.location.reload();
        }, 400);
    };

    const isSubmitting = ref(false);
    const form = useForm({
        code: '',
    });

    const resendForm = useForm({});

    const resendVerification = () => {
        resendForm.post(route('verification.send'), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                openModal();
            },
        });
    };

    const submit = () => {
        if (isSubmitting.value) return;
        isSubmitting.value = true;
        setTimeout(() => {
            form.post(route('verification.verify'));
        }, 750);
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
                    We hebben je een mail met de bevestigingscode gestuurd.<br>
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
                                        ref="codeInput"
                                        autofocus
                                    />
                                </div>
                                <InputError class="mt-2" :message="form.errors.code" />
                            </div>

                            <div class="flex flex-col items-center justify-center">
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
                    <div class="flex justify-center">
                        <Link
                            @click.prevent="resendVerification"
                            as="button"
                            class="rounded-md text-base font-medium link-underline-green focus:ring-2 focus:ring-blue-700 focus:ring-offset-2"
                        >
                            Geen mail ontvangen? Klik hier om de code opnieuw te sturen.
                        </Link>
                    </div>
                </GradientWhiteElement>
            </GradientElement>
        </div>

        <DefaultModal :show="isModalVisible" @close="closeModal">
            <template #title>
                We hebben een nieuwe mail gestuurd
            </template>
            <template #content>
                <div>
                    <p>Met de code die je ontvangt, kun je je e-mailadres bevestigen.</p>
                </div>
            </template>
        </DefaultModal>
    </Layout>
</template>
