<template>
  <app-layout>
   <template #currentPageNav>
     <inertia-link class="hover:underline" :href="route('dashboard')"> Home </inertia-link>
        <span class="px-2">&rarr;</span>
      <inertia-link class="hover:underline" :href="route('tribes.single', tribe.uuid)"> {{ tribe.name }} </inertia-link>
        <span class="px-2">&rarr;</span>
        <p class="underline">{{ note.title }}</p>
   </template>

   <div>
     <div class="flex flex-col md:grid md:grid-cols-12">
        <div class="md:col-span-8 bg-white">
          <div class="flex items-center pr-2">
            <h3 class="py-6 px-2 text-lg font-medium text-gray-800 w-full">
            {{ note.title }}
            </h3>
          </div>
          <EditorWrapper :loaded-content="loadedContent" view-only />
        </div>
     </div>
   </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import EditorWrapper from '@/components/functional/editor/EditorWrapper.vue'
import Sidebar from '@/components/functional/Sidebar.vue'

export default {
  components: {
    AppLayout,
    EditorWrapper,
    Sidebar
  },
  props: {
    note: {
      type: Object,
    },
    tribe: {
      type: Object
    }
  },
  computed: {
    loadedContent() {
      return this.note.parsedContent
    }
  },
}
</script>

<style>

</style>