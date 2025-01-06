<script setup>
    import {Link} from "@inertiajs/vue3";
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
                        @johndoe
                    </p>
                </div>
            </div>
            <div class="flex flex-col justify-center gap-y-2 pt-5 ">
<!--                <button class="button-four">Volgen</button>-->
<!--                <button class="button-four">Ontvolgen</button>-->
                <button class="button-four">Stuur bericht</button>
                <button class="button-four">Melden</button>
            </div>
        </div>
    </div>
    <div class="flex w-full gap-x-2 py-4 bg-gray-200">
        <Link href="/profiel">
            <button
                :class="{
                    'button-two-current': $page.url === '/profiel',
                    'button-two': $page.url !== '/profiel',
                }"
            >
                Overzicht
            </button>
        </Link>
        <Link href="/profiel/resultaten">
            <button
                :class="{
                    'button-two-current': $page.url === '/profiel/resultaten',
                    'button-two': $page.url !== '/profiel/resultaten',
                }"
            >
                Resultaten
            </button>
        </Link>
        <Link href="/profiel/instellingen">
            <button
                :class="{
                    'button-two-current': $page.url === '/profiel/instellingen',
                    'button-two': $page.url !== '/profiel/instellingen',
                }"
            >
                Instellingen
            </button>
        </Link>
        <Link href="/profiel/lidmaatschap">
            <button
                :class="{
                    'button-two-current': $page.url === '/profiel/lidmaatschap',
                    'button-two': $page.url !== '/profiel/lidmaatschap',
                }"
            >
                Lidmaatschap
            </button>
        </Link>
    </div>
</template>

<style scoped>

</style>
