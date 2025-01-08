<script setup>
    import { Link } from "@inertiajs/vue3";

    const props = defineProps({
        requestedUserId: String,
        isAuthenticatedUser: Boolean,
    });

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
                    <div class="flex items-center justify-center w-full h-full rounded-full bg-gray-400">
                        <p>
                            foto
                        </p>
                    </div>
                </div>
                <div class="flex flex-col justify-center pl-8">
                    <p class="text-header_s">
                        {{ $page.props.auth.user.name }}
                    </p>
                    <p>
                        {{ $page.props.auth.user.tag_name }}
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
        <Link :href="`/profiel/${requestedUserId}/overzicht`">
            <button
                :class="{
                    'button-two-current': $page.component === `Profiel/ProfielOverzicht`,
                    'button-two': $page.component !== `Profiel/ProfielOverzicht`,
                }"
            >
                Overzicht
            </button>
        </Link>
        <Link :href="`/profiel/${requestedUserId}/resultaten`">
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
            :href="`/profiel/${requestedUserId}/instellingen`"
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
            :href="`/profiel/${requestedUserId}/lidmaatschap`"
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
