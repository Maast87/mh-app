<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, useForm, usePage} from "@inertiajs/vue3";
    import {provide, ref, computed, watch} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import { useCurrentUser } from "@/Utilities/composables/useCurrentUser.js";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import {useConfirm} from "@/Utilities/composables/useComfirm.js";
    import defaultUserImage from '@/../../resources/images/mental-hygiene-default-user-image.png';
    import PasswordInput from '@/Components/PasswordInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import DefaultModal from "@/Components/Modals/DefaultModal.vue";
    import TextInput from '@/Components/TextInput.vue';

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "instellingen" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
    });

    const {confirmation} = useConfirm();

    const {isAuthenticatedUser} = useCurrentUser(props.requestedTagname);
    const hasSelectedFile = ref(false);
    const isUploading = ref(false);
    const showSaveButton = ref(false);
    const uploadProgress = ref(0);

    let progressInterval;

    const avatarForm = useForm({
        avatar: null,
    });

    const isFileTooLarge = computed(() => {
        return avatarForm.avatar && (avatarForm.avatar.size / 1024) > 1024;
    });

    const handleFileChange = (event) => {
        avatarForm.avatar = event.target.files[0];
        hasSelectedFile.value = event.target.files.length > 0;
        showSaveButton.value = false;
        uploadProgress.value = 0;

        if (hasSelectedFile.value) {
            // Start progress animation using the same cubic-bezier timing
            const duration = 2000;
            const steps = 100;
            const stepDuration = duration / steps;

            setTimeout(() => {
                const startTime = Date.now();
                progressInterval = setInterval(() => {
                    const elapsed = Date.now() - startTime;
                    if (elapsed < duration) {
                        // Use the same cubic-bezier function as the circle
                        const progress = cubicBezier(0.1, 0.7, 1.0, 0.1, elapsed / duration);
                        uploadProgress.value = progress * 100;
                    } else {
                        clearInterval(progressInterval);
                        uploadProgress.value = 100;
                    }
                }, stepDuration);
            }, 500); // Same delay as the circle animation

            setTimeout(() => {
                showSaveButton.value = true;
                clearInterval(progressInterval);
                uploadProgress.value = 100;
            }, 2600);
        }
    };

    // Cubic bezier function to match the circle's animation
    function cubicBezier(x1, y1, x2, y2, t) {
        const cx = 3 * x1;
        const bx = 3 * (x2 - x1) - cx;
        const ax = 1 - cx - bx;

        const cy = 3 * y1;
        const by = 3 * (y2 - y1) - cy;
        const ay = 1 - cy - by;

        const sampleCurveX = (t) => ((ax * t + bx) * t + cx) * t;
        const sampleCurveY = (t) => ((ay * t + by) * t + cy) * t;

        // Find t for given x using Newton-Raphson iteration
        let t0 = t;
        for (let i = 0; i < 4; i++) {
            const x = sampleCurveX(t0) - t;
            if (Math.abs(x) < 0.001) break;
            const dx = ((3 * ax * t0 + 2 * bx) * t0 + cx);
            if (Math.abs(dx) < 0.000001) break;
            t0 = t0 - x / dx;
        }

        return sampleCurveY(t0);
    }

    const submitAvatar = () => {
        if (!avatarForm.avatar) {
            return;
        }

        clearInterval(progressInterval);
        hasSelectedFile.value = false;
        showSaveButton.value = false;
        isUploading.value = true;
        uploadProgress.value = 0;

        avatarForm.post('/profile/avatar', {
            preserveScroll: true,
            onSuccess: () => {
                avatarForm.reset('avatar');
                isUploading.value = false;
            }
        });
    };

    const deleteAvatar = async () => {
        if (! await confirmation('Bevestig deze actie', 'Weet je zeker dat je je profielfoto wilt verwijderen? Deze actie is definitief.')) {
            return;
        }

        avatarForm.delete('/profile/avatar', {
            preserveScroll: true,
            onSuccess: () => {
                avatarForm.reset();
                hasSelectedFile.value = false;
                isUploading.value = false;
                showSaveButton.value = false;
            }
        });
    };

    const cancelUpload = () => {
        clearInterval(progressInterval);
        avatarForm.reset('avatar');
        hasSelectedFile.value = false;
        showSaveButton.value = false;
        isUploading.value = false;
        uploadProgress.value = 0;
    };

    const chooseNewFile = () => {
        clearInterval(progressInterval);
        uploadProgress.value = 0;

        // Trigger file input click
        document.getElementById('avatar').click();
    };

    const passwordForm = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const passwordValidations = ref({
        minLength: false,
        hasUppercase: false,
        hasNumber: false
    });

    const passwordConfirmationError = ref('');
    let passwordConfirmationTimeout;

    watch(() => passwordForm.password, (newPassword) => {
        passwordValidations.value.minLength = newPassword.length >= 10;
        passwordValidations.value.hasUppercase = /[A-Z]/.test(newPassword);
        passwordValidations.value.hasNumber = /\d/.test(newPassword);
        // Clear confirmation error when password changes
        passwordConfirmationError.value = '';
    });

    watch(() => passwordForm.password_confirmation, (newConfirmation) => {
        clearTimeout(passwordConfirmationTimeout);
        passwordConfirmationError.value = '';
        
        if (!newConfirmation) return;

        passwordConfirmationTimeout = setTimeout(() => {
            if (newConfirmation !== passwordForm.password) {
                passwordConfirmationError.value = 'De wachtwoorden komen niet overeen.';
            }
        }, 500);
    });

    const isPasswordFormValid = computed(() => {
        return passwordForm.current_password && 
               passwordForm.password && 
               passwordForm.password_confirmation &&
               passwordForm.password === passwordForm.password_confirmation &&
               passwordValidations.value.minLength &&
               passwordValidations.value.hasUppercase &&
               passwordValidations.value.hasNumber;
    });

    const updatePassword = () => {
        passwordForm.put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => {
                openModal();
                passwordForm.reset();
            }
        });
    };

    const isModalVisible = ref(false);

    const openModal = () => {
        isModalVisible.value = true;
    };

    const closeModal = () => {
        isModalVisible.value = false;
    };

    const emailForm = useForm({
        email: '',
        email_confirmation: ''
    });

    const currentEmail = usePage().props.auth.user.email;
    const emailError = ref('');
    const isEmailSame = ref(false);

    // Add debounced watcher for email validation
    let emailCheckTimeout;
    watch(() => emailForm.email, (newEmail) => {
        clearTimeout(emailCheckTimeout);
        emailError.value = '';
        isEmailSame.value = false;

        if (!newEmail) return;

        emailCheckTimeout = setTimeout(() => {
            if (newEmail.toLowerCase() === currentEmail.toLowerCase()) {
                emailError.value = 'Het nieuwe e-mailadres moet verschillen van je huidige e-mailadres.';
                isEmailSame.value = true;
            }
        }, 500);
    });

    const isEmailFormValid = computed(() => {
        return emailForm.email && 
               emailForm.email_confirmation && 
               emailForm.email === emailForm.email_confirmation &&
               !isEmailSame.value;
    });

    const confirmEmailChange = async () => {
        if (! await confirmation(
            'E-mailadres wijzigen',
            `Je staat op het punt om het e-mailadres wat aan je account gekoppeld is te wijzigen van ${currentEmail} naar ${emailForm.email}. Wil je deze doorgaan met deze actie? Als je op 'bevestig' klikt, sturen we een bevestigingscode naar het nieuwe mailadres.`
        )) {
            return;
        }

        emailForm.post(route('email.update'));
    };
</script>

<template>
    <Layout>
        <Head title="Profiel instellingen" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />
            <div class="flex flex-col w-full gap-y-6 p-6 bg-gray-100 rounded-xl">
                <div id="avatar" class="border border-0 border-b border-blue_700_gray_100 pb-4">
                    <div class="flex flex-col w-2/3 gap-y-6">
                        <div>
                            <h3 class="text-header_s text-blue_700_gray_100">Profielfoto</h3>
                            <p class="text-base text-blue_700_gray_100">De foto die je kiest is zichtbaar voor anderen op het Mental Hygiene Platform. Bijvoorbeeld op je profiel, of wanneer je een bericht plaatst. Je kunt je foto altijd weer verwijderen. Het is geen verplichting om een foto te kiezen.</p>
                        </div>
                        <div class="flex gap-x-6 ">
                            <div>
                                <div v-if="$page.props.auth.user?.avatar" class="relative">
                                    <img
                                        :src="$page.props.auth.user.avatar"
                                        alt="Profile picture"
                                        class="rounded-full w-32 h-32 object-cover border-2 border-gray-200"
                                    />
                                </div>
                                <div v-else class="relative">
                                    <img
                                        :src="defaultUserImage"
                                        alt="Default profile picture"
                                        class="rounded-full w-32 h-32 object-cover"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col justify-center gap-y-4">
                                <div class="flex flex-col bg-gray-300 p-2 rounded-xl">
                                    <div>
                                        <div>
                                            <p class="text-base font-bold text-blue_700_gray_100">Je profielfoto wijzigen</p>
                                            <p class="text-base text-blue_700_gray_100">De maximale bestandsgrootte is 1024 KB. We ondersteunen PNG, JPG en JPEG bestanden. </p>
                                        </div>
                                        <div class="flex justify-center border border-0 border-t border-blue_700_gray_100 gap-x-4 mt-3 pt-4 w-full">
                                            <div class="w-full">
                                                <form
                                                    v-if="isAuthenticatedUser"
                                                    @submit.prevent="submitAvatar"
                                                    class="flex-col w-full"
                                                >
                                                    <div>
                                                        <div v-if="! isUploading && ! hasSelectedFile">
                                                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2 sr-only">
                                                                Kies een profielfoto
                                                            </label>
                                                            <div class="relative w-full">
                                                                <button
                                                                    type="button"
                                                                    @click="$refs.fileInput.click()"
                                                                    class="w-full button-one text-center"
                                                                >
                                                                    Kies een nieuwe profielfoto
                                                                </button>
                                                                <input
                                                                    type="file"
                                                                    id="avatar"
                                                                    ref="fileInput"
                                                                    @change="handleFileChange"
                                                                    class="hidden"
                                                                    accept="image/*"
                                                                />
                                                            </div>
                                                            <div v-if="avatarForm.errors.avatar" class="text-red-500 text-sm mt-1">
                                                                {{ avatarForm.errors.avatar }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div v-if="hasSelectedFile" class="flex flex-col justify-between bg-gray-300 rounded-lg">
                                                            <div class="flex justify-between w-full">
                                                                <div>
                                                                    <p v-if="hasSelectedFile" class="text-sm text-blue_700_gray_100 font-medium">
                                                                        {{ avatarForm.avatar.name }}
                                                                    </p>
                                                                    <p v-if="hasSelectedFile" class="text-sm text-blue_700_gray_100">
                                                                        {{ Math.round(avatarForm.avatar.size / 1024) }} KB
                                                                    </p>
                                                                </div>
                                                                <div v-if="hasSelectedFile" class="flex justify-end items-center gap-x-2">
                                                                    <div>
                                                                        <p v-if="hasSelectedFile" class="text-sm text-blue_700_gray_100">
                                                                            <span class="font-medium">Uploaden</span> {{ Math.round(uploadProgress) }}%
                                                                        </p>
                                                                    </div>
                                                                    <div class="relative w-8 h-8">
                                                                        <svg class="transform -rotate-90 w-8 h-8">
                                                                            <!-- Solid background circle -->
                                                                            <circle
                                                                                cx="16"
                                                                                cy="16"
                                                                                r="16"
                                                                                fill="#D8DADD"
                                                                            />
                                                                            <!-- Progress circle -->
                                                                            <circle
                                                                                cx="16"
                                                                                cy="16"
                                                                                r="12"
                                                                                stroke="#0E122C"
                                                                                stroke-width="3"
                                                                                stroke-linecap="round"
                                                                                fill="none"
                                                                                class="progress-circle"
                                                                            />
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-if="showSaveButton && !isFileTooLarge" class="flex gap-x-4 mt-4">
                                                                <ButtonOne
                                                                    type="submit"
                                                                    :disabled="avatarForm.processing"
                                                                    title="Opslaan"
                                                                >
                                                                </ButtonOne>
                                                                <ButtonOne
                                                                    @click="cancelUpload"
                                                                    :disabled="avatarForm.processing"
                                                                    title="Annuleer"
                                                                >
                                                                </ButtonOne>
                                                            </div>
                                                            <div v-if="showSaveButton && isFileTooLarge" id="error-message" class="flex flex-col gap-y-2 mt-4 border border-blue_700_gray_100 rounded-lg p-2">
                                                                <div class="flex gap-x-4">
                                                                    <div class="w-20 h-20">
                                                                        <svg
                                                                            id="uuid-5e00ec1d-c691-43cc-a035-8f7535066b85"
                                                                            data-name="Content"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 128 128"
                                                                        >
                                                                            <path d="M60.97,21.37L17.23,97.14c-1.35,2.33.34,5.24,3.03,5.24h87.49c2.69,0,4.37-2.91,3.03-5.24L67.03,21.37c-1.35-2.33-4.71-2.33-6.05,0Z" style="fill: none; stroke: var(--mh-red-200); stroke-miterlimit: 10; stroke-width: 4.5px;"/>
                                                                            <line x1="64" y1="46.5" x2="64" y2="78.5" style="fill: none; stroke: var(--mh-red-200); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                                                            <circle cx="64" cy="86" r=".5" style="fill: none; stroke: var(--mh-red-200); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="flex flex-col justify-center">
                                                                        <p class="text-base text-blue_700_gray_100 font-bold">Oeps...</p>
                                                                        <p class="text-sm text-blue_700_gray_100">De foto die je hebt geüpload is te groot.<br>De limiet is 1024 KB, en jouw foto is {{ Math.round(avatarForm.avatar.size / 1024) }} KB.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex gap-x-4 border border-0 border-t border-blue_700_gray_100 pt-4">
                                                                    <ButtonOne
                                                                        @click="cancelUpload"
                                                                        :disabled="avatarForm.processing"
                                                                        title="Terug"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div
                                                v-if="! isUploading && ! hasSelectedFile && $page.props.auth.user?.avatar"
                                                class="w-full"
                                            >
                                                <ButtonOne
                                                    @click="deleteAvatar"
                                                    :disabled="avatarForm.processing"
                                                    title="Verwijder huidige profielfoto"
                                                    class="w-full"
                                                >
                                                </ButtonOne>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="update-password" class="border border-0 border-b border-blue_700_gray_100 pb-4">
                    <div class="flex flex-col w-1/2 gap-y-6">
                        <div>
                            <h3 class="text-header_s text-blue_700_gray_100">Wachtwoord wijzigen</h3>
                            <p class="text-base text-blue_700_gray_100">Wijzig je wachtwoord.</p>
                        </div>
                        <div class="flex flex-col gap-y-6">
                            <form @submit.prevent="updatePassword" class="flex flex-col gap-y-6">
                                <div>
                                    <InputLabel for="current_password" value="Huidig wachtwoord" />
                                    <PasswordInput
                                        v-model="passwordForm.current_password"
                                        id="current_password"
                                        name="current_password"
                                        required
                                        autocomplete="current-password"
                                    />
                                    <InputError class="mt-1.5" :message="passwordForm.errors.current_password"/>
                                </div>

                                <div>
                                    <InputLabel for="password" value="Nieuw wachtwoord" />
                                    <PasswordInput
                                        v-model="passwordForm.password"
                                        id="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                    />
                                    <InputError class="mt-1.5" :message="passwordForm.errors.password"/>
                                    <p class="text-sm mt-1.5 text-blue_700_gray_100">
                                        Wachtwoord checklist:
                                    </p>
                                    <div>
                                        <ul class="text-sm">
                                            <li
                                                :class="{
                                                    'text-green-100': passwordValidations.minLength,
                                                    'text-blue-700 opacity-60': !passwordValidations.minLength
                                                }"
                                                class="list-disc pl-5"
                                                style="list-style-position: inside"
                                            >
                                                Minimale lengte van 10 tekens
                                            </li>
                                            <li
                                                :class="{
                                                    'text-green-100': passwordValidations.hasUppercase,
                                                    'text-blue-700 opacity-60': !passwordValidations.hasUppercase
                                                }"
                                                class="list-disc pl-5"
                                                style="list-style-position: inside"
                                            >
                                                Ten minste 1 hoofdletter
                                            </li>
                                            <li
                                                :class="{
                                                    'text-green-100': passwordValidations.hasNumber,
                                                    'text-blue-700 opacity-60': !passwordValidations.hasNumber
                                                }"
                                                class="list-disc pl-5"
                                                style="list-style-position: inside"
                                            >
                                                Ten minste 1 cijfer
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <InputLabel for="password_confirmation" value="Bevestig nieuw wachtwoord" />
                                    <PasswordInput
                                        v-model="passwordForm.password_confirmation"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    />
                                    <InputError class="mt-1.5" :message="passwordForm.errors.password_confirmation"/>
                                    <InputError class="mt-1.5" :message="passwordConfirmationError"/>
                                </div>

                                <div>
                                    <ButtonOne
                                        title="Wijzig wachtwoord"
                                        :class="{ 'opacity-50 pointer-events-none': !isPasswordFormValid }"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="update-email" class="border border-0 border-b border-blue_700_gray_100 pb-4">
                    <div class="flex flex-col w-1/2 gap-y-6">
                        <div>
                            <h3 class="text-header_s text-blue_700_gray_100">E-mailadres wijzigen</h3>
                            <p class="text-base text-blue_700_gray_100">Wijzig je e-mailadres. Je huidige e-mailadres is {{ currentEmail }}.</p>
                        </div>
                        <div class="flex flex-col w-full gap-y-6">
                            <form @submit.prevent="confirmEmailChange" class="space-y-6">
                                <div>
                                    <InputLabel for="email" value="Nieuw e-mailadres" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="emailForm.email"
                                        required
                                        autocomplete="email"
                                    />
                                    <InputError :message="emailForm.errors.email" class="mt-2" />
                                    <InputError :message="emailError" class="mt-2" />
                                </div>

                                <div>
                                    <InputLabel for="email_confirmation" value="Bevestig nieuw e-mailadres" />
                                    <TextInput
                                        id="email_confirmation"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="emailForm.email_confirmation"
                                        required
                                        autocomplete="email"
                                    />
                                    <InputError :message="emailForm.errors.email_confirmation" class="mt-2" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <ButtonOne
                                        title="Wijzig e-mailadres"
                                        :class="{ 'opacity-50 pointer-events-none': !isEmailFormValid }"
                                    />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="data-visibility" class="border border-0 border-b border-blue_700_gray_100 pb-4">
                    <div class="flex flex-col w-2/3 gap-y-6">
                        <div>
                            <h3 class="text-header_s text-blue_700_gray_100">Zichtbaarheid van je data</h3>
                            <p class="text-base text-blue_700_gray_100">Wijzig wie je data kunt zien.</p>
                        </div>
                        <div class="flex">
                            <p>Hier komt de content</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DefaultModal :show="isModalVisible" @close="closeModal">
            <template #title>
                Het is gelukt!
            </template>
            <template #content>
                <div>
                    <p>De volgende keer dat je inlogt, kun je je nieuwe wachtwoord gebruiken.</p>
                </div>
            </template>
        </DefaultModal>
    </Layout>
</template>

<style scoped>
    input[type="file"] {
        color: transparent;
        position: relative;
    }

    input[type="file"]::-webkit-file-upload-button {
        visibility: hidden;
    }

    input[type="file"]::before {
        content: 'Kies een nieuwe profielfoto';
        color: rgb(31 41 55); /* text-gray-800 */
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        text-align: center;
    }

    .progress-circle {
        stroke-dasharray: 75.40; /* 2 * π * 12 (radius) */
        stroke-dashoffset: 75.40;
        animation: progress-circle 2s cubic-bezier(0.1, 0.7, 1.0, 0.1) 0.5s forwards;
    }

    @keyframes progress-circle {
        0% {
            stroke-dashoffset: 75.40;
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
</style>
