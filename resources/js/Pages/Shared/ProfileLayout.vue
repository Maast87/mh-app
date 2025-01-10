<script setup>
    import { Link } from "@inertiajs/vue3";
    import defaultUserImage from '../../../images/mental-hygiene-default-user-image.png';
    import { useCurrentUser } from "@/Utilities/composables/useCurrentUser.js";
    import { usePage } from "@inertiajs/vue3";
    import { computed } from 'vue';

    const props = defineProps({
        requestedTagname: {
            type: String,
            required: true
        },
        requestedUser: {
            type: Object,
            default: null
        }
    });

    const page = usePage();
    const authUser = page.props.auth.user;

    console.log('ProfileLayout - Props:', {
        requestedTagname: props.requestedTagname,
        requestedUser: props.requestedUser,
        authUser: authUser,
        currentRoute: page.url,
        component: page.component
    });

    const { isAuthenticatedUser } = useCurrentUser(props.requestedTagname);
</script>

<template>
    <div>
        <div class="flex w-full border border-white border-0 border-r border-l border-t rounded-tl-xl rounded-tr-xl">
            <img
                class="rounded-tl-xl rounded-tr-xl"
                src="../../../images/mental-hygiene-profile-background.png"
                alt="Mental Hygiene profiel achtergrondafbeelding"
            >
        </div>
        <div class="flex w-full justify-between bg-gray-100 rounded-bl-xl rounded-br-xl pb-5 px-5 border border-white border-0 border-r border-l border-b rounded-bl-xl rounded-br-xl ml-[1px] mr-[1px]">
            <div class="flex">
                <div class="flex items-center justify-center w-[175px] h-[175px] rounded-full bg-gray-100 mt-[-30px] p-1">
                    <div class="flex items-center justify-center w-full h-full rounded-full">
                        <div class="w-full h-full" v-if="$page.props.requestedUser.avatar">
                            <img
                                :src="$page.props.requestedUser.avatar"
                                alt="Profile picture"
                                class="w-full h-full rounded-full object-cover"
                            />
                        </div>
                        <div class="w-full h-full" v-if="! $page.props.requestedUser.avatar">
                            <img
                                :src="defaultUserImage"
                                alt="Default profile picture"
                                class="w-full h-full rounded-full object-cover"
                            />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center pl-8">
                    <p class="text-header_s">
                        <span>{{ $page.props.requestedUser.name }}</span>
                    </p>
                    <p>
                        <span>{{ $page.props.requestedUser.tag_name }}</span>
                    </p>
                </div>
            </div>
            <div class="flex flex-col justify-center gap-y-2 pt-5 ">
                <button v-if="! isAuthenticatedUser" class="button-four">Stuur bericht</button>
                <button v-if="! isAuthenticatedUser" class="button-four">Melden</button>
            </div>
        </div>
    </div>
    <div class="flex w-full gap-x-2 py-4 bg-gray-200">
        <Link :href="`/profiel/${requestedTagname}/overzicht`">
            <button
                v-if="isAuthenticatedUser"
                :class="{
                    'button-two-current': $page.component === `Profiel/ProfielOverzicht`,
                    'button-two': $page.component !== `Profiel/ProfielOverzicht`,
                }"
            >
                Overzicht
            </button>
        </Link>
        <Link :href="`/profiel/${requestedTagname}/resultaten`">
            <button
                :class="{
                    'button-two-current': $page.component === `Profiel/ProfielResultaten`,
                    'button-two': $page.component !== `Profiel/ProfielResultaten`,
                }"
            >
                Resultaten
            </button>
        </Link>
        <Link
            v-if="isAuthenticatedUser"
            :href="`/profiel/${requestedTagname}/instellingen`"
        >
            <button
                :class="{
                    'button-two-current': $page.component === `Profiel/ProfielInstellingen`,
                    'button-two': $page.component !== `Profiel/ProfielInstellingen`,
                }"
            >
                Instellingen
            </button>
        </Link>
        <Link
            v-if="isAuthenticatedUser"
            :href="`/profiel/${requestedTagname}/lidmaatschap`"
        >
            <button
                :class="{
                    'button-two-current': $page.component === `Profiel/ProfielLidmaatschap`,
                    'button-two': $page.component !== `Profiel/ProfielLidmaatschap`,
                }"
            >
                Lidmaatschap
            </button>
        </Link>
    </div>
</template>
