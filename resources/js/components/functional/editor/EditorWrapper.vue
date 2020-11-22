<template>
  <div class="h-full">
    <EditorMenu :editor="editor" class="w-full bg-gray-200" v-if="!viewOnly" />
    <EditorContent ref="editor" :editor="editor" class="wysiwyg px-2 py-4 h-96 focus:outline-none"/>
  </div>
</template>

<script>
import { Editor, EditorContent } from 'tiptap'
import defaultExtensions from './defaultExtensions.list.js'
import EditorMenu from './EditorMenu'

export default {
  name: 'EditorWrapper',
  components: {
    EditorMenu,
    EditorContent
  },
  props: {
    loadedContent: {
      type: Array,
      default: () => ''
    },
    viewOnly: {
      type: Boolean,
      default: () => false
    },
  },
  data () {
    return {
      editor: null,
      json: null,
      content: []
    }
  },
  watch: {
    json(newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('edit', newVal)
      }
    }
  },
  mounted() {
    this.editor = new Editor({
      extensions: [
        ...defaultExtensions()
      ],
      editable: !this.viewOnly,
      content: null,
      onUpdate: () => {
        const changes = {
          key: 'content',
          value: this.editor.getJSON().content
        }

        this.json = changes.value
        //this.$store.dispatch('changeCurrentlyEditing', changes)
      }
    })

    this.editor.setContent({
        type: 'doc',
        content: this.loadedContent
      }, true)

  },
  beforeDestroy () {
    // this.saveContent()
    this.editor.destroy()
  },

}
</script>

<style>
.wysiwyg > .ProseMirror {
  @apply h-full text-lg text-gray-800 leading-normal p-2;
}
.wysiwyg > * + *, .wysiwyg li > p + p {
  @apply mt-6;
}
.wysiwyg strong {
  @apply text-black font-bold;
}
.wysiwyg a {
  @apply text-black font-semibold;
}
.wysiwyg strong a {
  @apply font-bold;
}
.wysiwyg h2 {
  @apply leading-tight text-2xl font-bold text-black mb-6;
}
.wysiwyg h3 {
  @apply leading-tight text-xl font-bold text-black mb-4;
}
.wysiwyg h4 {
  @apply leading-tight text-xl font-medium uppercase text-gray-700 mb-4;
}
.wysiwyg code {
  @apply font-mono text-sm inline bg-gray-100 px-1;
}
.wysiwyg pre code {
  @apply block bg-black p-4 rounded;
}
.wysiwyg blockquote {
  @apply border-l-4 border-gray-200 pl-4 italic;
}
.wysiwyg ul, .wysiwyg ol {
  @apply pl-5;
  @screen sm {
    @apply pl-10;
  }
}
.wysiwyg ol {
  list-style-type: decimal;
}
.wysiwyg ul {
  list-style-type: disc;
}
</style>