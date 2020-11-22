<template>
  <app-layout>
    <Toolbar page="tribes" />
    <template #currentPageNav>
      <inertia-link :href="route('dashboard')"> Home </inertia-link>
        <span class="px-2">&rarr;</span>
      <inertia-link :href="route('tribes.all')"> Tribes </inertia-link>
    </template>

    <div>
      <div class="mb-8">
        <inertia-link :href="route('notes.all')" class="font-bold text-xl text-gray-500 inline-flex mr-8">Entries
          <span class="text-gray-400 text-sm pl-1">{{ notes.length }}</span>
        </inertia-link>
        <h1 class="font-bold text-xl text-black inline-flex">Tribes
          <span class="text-gray-400 text-sm pl-1">{{ tribes.length }}</span>
        </h1>
      </div>

      <div class="grid grid-cols-4 gap-4">
        <Card v-for="tribe in tribes" :key="tribe.id" type="tribe" :tribe="tribe" />
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
}
</script>
