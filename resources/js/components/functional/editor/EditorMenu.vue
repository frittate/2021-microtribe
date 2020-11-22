<template>
  <editor-menu-bar v-slot="{ commands, isActive }" :editor="editor">
    <div class="inline-flex">
      <editor-button
        :active="isActive.bold()"
        icon
        name="format-bold"
        @click="commands.bold"
      />
      <editor-button
        :active="isActive.italic()"
        icon
        name="format-italic"
        @click="commands.italic"
      />
      <editor-button
        :active="isActive.paragraph()"
        icon
        name="format-paragraph"
        @click="commands.paragraph"
      />
      <!--  <editor-button
        :active="isActive.heading({ level: 1 })"
        name="H1"
        @click="commands.heading({ level: 1 })"
      /> -->
      <editor-button
        :active="isActive.heading({ level: 2 })"
        name="H2"
        @click="commands.heading({ level: 2 })"
      />
      <editor-button
        :active="isActive.heading({ level: 3 })"
        name="H3"
        @click="commands.heading({ level: 3 })"
      />
      <editor-button
        :active="isActive.heading({ level: 4 })"
        name="H4"
        @click="commands.heading({ level: 4 })"
      />
      <editor-button
        :active="isActive.bullet_list()"
        icon
        name="format-list-bulleted"
        @click="commands.bullet_list"
      />
      <editor-button
        :active="isActive.ordered_list()"
        icon
        name="format-list-numbered"
        @click="commands.ordered_list"
      />
      <editor-button
        :active="isActive.code_block()"
        icon
        name="code-braces"
        @click="commands.code_block"
      />
      <editor-button
        icon
        name="image"
        @click="showImagePrompt(commands.image)"
      />
      <editor-button
        icon
        name="minus"
        @click="commands.horizontal_rule"
      />
      <editor-button
        icon
        name="undo"
        @click="commands.undo"
      />
      <editor-button
        icon
        name="redo"
        @click="commands.redo"
      />
    </div>
  </editor-menu-bar>
</template>

<script>
import { EditorMenuBar } from 'tiptap'
import EditorButton from './EditorButton'

export default {
  components: {
    EditorMenuBar,
    EditorButton
  },
  props: {
    editor: {
      type: Object,
      default: () => {}
    }
  },
  methods: {
    showImagePrompt (command) {
     
    }
  }
}
</script>
