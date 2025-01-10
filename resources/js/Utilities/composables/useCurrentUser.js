import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export function useCurrentUser(requestedTagname) {
    const page = usePage();

    const authenticatedTagNameComputed = computed(() => {
        return page.props.auth?.user?.tag_name;
    });

    const isAuthenticatedUserComputed = computed(() => {
        if (!authenticatedTagNameComputed.value) {
            return false;
        }
        
        // If requestedTagname is undefined, use the authenticated user's tagname
        const effectiveRequestedTagname = requestedTagname || authenticatedTagNameComputed.value;
        
        const normalizedRequestedTagname = effectiveRequestedTagname.startsWith('@') ? effectiveRequestedTagname : `@${effectiveRequestedTagname}`;
        const normalizedAuthenticatedTagname = authenticatedTagNameComputed.value.startsWith('@') ? authenticatedTagNameComputed.value : `@${authenticatedTagNameComputed.value}`;
        return normalizedRequestedTagname === normalizedAuthenticatedTagname;
    });
    
    const authenticatedTagName = authenticatedTagNameComputed.value;
    const isAuthenticatedUser = isAuthenticatedUserComputed.value;
    
    return { isAuthenticatedUser, authenticatedTagName }
}
