<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, useForm} from "@inertiajs/vue3";
    import {provide, ref} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import { useCurrentUser } from "@/Utilities/composables/useCurrentUser.js";
    import ButtonFour from "@/Components/Buttons/ButtonFour.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "instellingen" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedUserId: String,
    })

    const {isAuthenticatedUser, authenticatedUserId } = useCurrentUser(props.requestedUserId);
    const hasSelectedFile = ref(false);
    const isUploading = ref(false);

    const avatarForm = useForm({
        avatar: null,
    });

    const handleFileChange = (event) => {
        avatarForm.avatar = event.target.files[0];
        hasSelectedFile.value = event.target.files.length > 0;
        showSaveButton.value = false;
    };

    const submitAvatar = () => {
        if (!avatarForm.avatar) {
            return;
        }

        isUploading.value = true;

        avatarForm.post('/profile/avatar', {
            preserveScroll: true,
            onSuccess: () => {
                setTimeout(() => {
                    avatarForm.reset('avatar');
                    hasSelectedFile.value = false;
                    isUploading.value = false;
                }, 2500);
            }
        });
    };
</script>

<template>
    <Layout>
        <Head title="Profiel" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedUserId="requestedUserId" :isAuthenticatedUser="isAuthenticatedUser" />
            <div class="flex flex-col w-full gap-x-4 p-6 bg-gray-100 rounded-xl">
                <div>
                    <h3 class="text-header_s text-blue_700_gray_100">Profielfoto</h3>
                    <p class="text-base text-blue_700_gray_100 w-1/2">De foto die je kiest is zichtbaar voor anderen op het Mental Hygiene Platform. Bijvoorbeeld op je profiel, of wanneer je een bericht plaatst. Je kunt je foto altijd weer verwijderen. Het is geen verplichting om een foto te kiezen.</p>
                </div>
                <div class="flex gap-x-6">
                    <div>
                        <div v-if="$page.props.auth.user?.avatar" class="relative">
                            <img
                                :src="$page.props.auth.user.avatar"
                                alt="Profile picture"
                                class="rounded-full w-32 h-32 object-cover border-2 border-gray-200"
                            />
                        </div>
                        <div v-else class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400">No image</span>
                        </div>
                    </div>
                    <div>
                        <form v-if="isAuthenticatedUser" @submit.prevent="submitAvatar" class="space-y-6">
                            <div class="flex flex-col items-center">
                                <div>
                                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2 sr-only">
                                        Choose a profile picture
                                    </label>
                                    <input
                                        type="file"
                                        id="avatar"
                                        @change="handleFileChange"
                                        class="file:hidden file:mt-4 button-four [&::file-selector-button]:mr-0 [&::-webkit-file-upload-button]:mr-0 !w-auto cursor-pointer"
                                        accept="image/*"
                                    />
                                    <div v-if="avatarForm.errors.avatar" class="text-red-500 text-sm mt-1">
                                        {{ avatarForm.errors.avatar }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p v-if="hasSelectedFile" class="text-sm text-gray-600 mt-2">
                                    {{ avatarForm.avatar.name }}
                                </p>
                                <div v-if="hasSelectedFile" class="w-full h-1 bg-gray-200 rounded-full mt-2">
                                    <div class="progress-bar h-full bg-lime-500 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <ButtonFour
                                    v-if="hasSelectedFile"
                                    type="submit"
                                    :disabled="avatarForm.processing"
                                    title="Save"
                                >
                                </ButtonFour>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
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
    content: 'Kies een foto';
    color: rgb(31 41 55); /* text-gray-800 */
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    text-align: center;
}

.progress-bar {
    width: 0;
    animation: progress 2s ease-out 0.5s forwards;
}

@keyframes progress {
    0% {
        width: 0;
    }
    100% {
        width: 100%;
    }
}
</style>
