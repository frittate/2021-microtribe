<template>
  <app-layout>
    <Toolbar page="notes" show-filters show-main-action />
    <template #currentPageNav>
      <inertia-link class="hover:underline" :href="route('dashboard')"> Home </inertia-link>
        <span class="px-2">&rarr;</span>
      <inertia-link class="hover:underline" :href="route('notes.all')"> Notes </inertia-link>
    </template>

    <div>
      <div class="mb-8">
        <h1 class="font-bold text-xl text-black inline-flex mr-8">Entries
          <span class="text-gray-400 text-sm pl-1">{{ notes.length }}</span>
        </h1>
        <inertia-link :href="route('tribes.all')" class="font-bold text-xl text-gray-500 inline-flex">Tribes
          <span class="text-gray-400 text-sm pl-1">{{ tribes.length }}</span>
        </inertia-link>
      </div>

      <div class="grid grid-cols-4 gap-4">
        <Card v-for="note in notes" :key="note.id" type="note" :note="note" view="notes"/>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Card from '@/components/molecules/Card'
import Toolbar from '@/components/functional/Toolbar'

export default {
  components: {
    AppLayout,
    Card,
    Toolbar
  },
  props: {
    tribes: Array,
    notes: Array
  },
  data() {
    return {
      form: {
        title: ''
      }
    }
  },
  methods: {
    submit() {
      this.$inertia.post('/notes', this.form, {
        onSuccess: () => {
          this.form.title = ''
        }
      })
    },
  }
}
</script>
