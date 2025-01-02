import { ref, onMounted } from "vue";

const dark = ref(false);

const toggleTheme = () => {
    const rootElem = document.documentElement;
    const currentTheme = rootElem.getAttribute("data-theme");

    const newTheme = currentTheme === "light" ? "dark" : "light";

    rootElem.setAttribute("data-theme", newTheme);
    dark.value = newTheme === "dark";

    localStorage.setItem("theme", newTheme);
};

const initializeTheme = () => {
    const rootElem = document.documentElement;
    const localTheme = localStorage.getItem("theme");
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

    const initialTheme = localTheme || (prefersDark ? "dark" : "light");
    rootElem.setAttribute("data-theme", initialTheme);
    dark.value = initialTheme === "dark";

    const prefersDarkMedia = window.matchMedia("(prefers-color-scheme: dark)");
    prefersDarkMedia.addEventListener("change", (event) => {
        const osTheme = event.matches ? "dark" : "light";
        const currentTheme = localStorage.getItem("theme");

        if (!currentTheme) {
            rootElem.setAttribute("data-theme", osTheme);
            dark.value = osTheme === "dark";
        }
    });
};

export function useTheme() {
    onMounted(() => initializeTheme());
    return { dark, toggleTheme };
}
