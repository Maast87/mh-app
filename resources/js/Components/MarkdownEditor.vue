<script setup>
    import {EditorContent, useEditor} from "@tiptap/vue-3";
    import {StarterKit} from "@tiptap/starter-kit";
    import {Link} from "@tiptap/extension-link";
    import {watch} from "vue";
    import {Markdown} from "tiptap-markdown";
    import {Placeholder} from "@tiptap/extension-placeholder";

    const props = defineProps({
        editorClass: '',
        placeholder: null,
    });

    const model = defineModel();

    const editor = useEditor({
       extensions: [
           StarterKit.configure({
               heading: {
                   levels: [2, 3, 4],
               },
               code: false,
               codeBlock: false,
           }),
           Link,
           Markdown,
           Placeholder.configure({
               placeholder: props.placeholder,
           }),
       ],
        editorProps: {
            attributes: {
                class: `min-h-[512px] prose prose-sm max-w-none py-1.5 px-3 ${props.editorClass}`,
            },
        },
        onUpdate: () =>
            model.value = editor.value?.storage.markdown.getMarkdown(), // propagate changes inside markdown editor to textarea
    });

    defineExpose({ focus: () => editor.value.commands.focus() })

    // propagate changes inside textarea to markdown editor
    watch(() => props.modelValue, (value) => {
        if (value === editor.value?.storage.markdown.getMarkdown()) {
            return;
        }

       editor.value?.commands.setContent(value);
    }, { immediate: true });

    const promptUserForHref = () => {
        if (editor.value?.isActive('link')) {
            return editor.value?.chain().focus().unsetLink().run();
        }

        const href = prompt('Waar wil je naartoe linken?');

        if (! href) {
            return editor.value?.chain().focus().run();
        }

        return editor.value?.chain().focus().setLink({ href }).run();
    };

</script>

<template>
    <div v-if="editor" class="border-blue_700_gray_100 border-2 bg-gray_100_blue_900 rounded-lg mb-4">
        <menu class="flex gap-x-1 border-b border-blue_700_gray_100">
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBold().run()"
                    type="button"
                    class="px-3 py-2 rounded-tl-lg"
                    :class="[editor.isActive('bold') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Bold"
                >
                    Bold
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleItalic().run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('italic') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Italic"
                >
                    Italic
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleStrike().run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('strike') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Strikethrough"
                >
                    Strikethrough
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBlockquote().run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('blockquote') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Blockquote"
                >
                    Blockquote
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleBulletList().run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('bulletList') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Bulletlist"
                >
                    Bulletlist
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleOrderedList().run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('orderedList') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Numeric list"
                >
                    Numeric list
                </button>
            </li>
            <li>
                <button
                    @click="promptUserForHref"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('link') ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Add link"
                >
                    Add link
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleHeading({ level: 2 }).run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('heading', { level: 2 }) ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Heading 1"
                >
                    Heading 1
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleHeading({ level: 3 }).run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('heading', { level: 3 }) ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Heading 2"
                >
                    Heading 2
                </button>
            </li>
            <li>
                <button
                    @click="() => editor.chain().focus().toggleHeading({ level: 4 }).run()"
                    type="button"
                    class="px-3 py-2"
                    :class="[editor.isActive('heading', { level: 4 }) ? 'bg-indigo-500' : 'hover:bg-gray-200']"
                    title="Heading 3"
                >
                    Heading 3
                </button>
            </li>
        </menu>
        <EditorContent :editor="editor" />
    </div>
</template>

<style scoped>
    :deep(.tiptap p.is-editor-empty:first-child::before) {
        @apply
            text-blue_700_gray_100
            opacity-65
            float-left
            h-0
            pointer-events-none;
        content: attr(data-placeholder);
    }
</style>
