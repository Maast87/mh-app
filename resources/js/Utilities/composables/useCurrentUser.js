import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";


export function useCurrentUser(requestedUserId) {

    const page = usePage();

    const authenticatedUserIdComputed = computed(() => {
        return page.props.auth.user.id;
    })

    const isAuthenticatedUserComputed = computed(() => {
            return requestedUserId == authenticatedUserId;
        });

    const authenticatedUserId = authenticatedUserIdComputed.value;
    const isAuthenticatedUser = isAuthenticatedUserComputed.value;

    return { isAuthenticatedUser, authenticatedUserId }
}
