<template>
  <app-layout>
    <Toolbar page="notes" :show-main-action="false" show-filters />

    <template #currentPageNav>
      <inertia-link class="hover:underline" :href="route('dashboard')"> Home </inertia-link>
        <span class="px-2">&rarr;</span>
      <inertia-link class="hover:underline" :href="route('tribes.all')"> Tribes </inertia-link>
        <span class="px-2">&rarr;</span>
      <p class="underline">{{ tribe.name }}</p>
    </template>

    <template v-slot:topContent>
      <div class="w-screen bg-gray-100">
        <div class="lg:max-w-7xl m-auto py-4">
          <h4 class="text-xs text-gray-400 uppercase mb-2">
            Welcome to
          </h4>
          <h3 class="text-black text-xl mb-4 font-bold">
            {{ tribe.name }}
          </h3>
          <p class="text-base text-gray-700 leading-6 max-w-md">
            {{ tribe.description }}
          </p>
        </div>
      </div>
      <div class="w-screen bg-gray-200">
        <div class="lg:max-w-7xl m-auto py-2">
          <h4 class="text-tiny text-gray-400 uppercase inline-block mb-2">
            Members
          </h4>
          <div>
            <img v-for="user in tribe.users" :key="user.id" :src="user.profile_photo_url" alt="" class="rounded-full h-10 w-10 inline-flex mr-2 border-gray-200">
          </div>
        </div>
      </div>
    </template>

    <div class="mb-8">
      <h1 class="font-bold text-xl text-black inline-flex mr-8">Entries
        <span class="text-gray-400 text-sm pl-1">{{ notes.length }}</span>
      </h1>
      <inertia-link :href="route('tribes.inbox', tribe.uuid)" class="font-bold text-xl text-gray-500 inline-flex mr-8">Inbox
        <span class="text-gray-400 text-sm pl-1">{{ inbox }}</span>
      </inertia-link>
      <inertia-link :href="route('tribes.archive', tribe.uuid)" class="font-bold text-xl text-gray-500 inline-flex">Archive
        <span class="text-gray-400 text-sm pl-1">{{ archived }}</span>
      </inertia-link>
    </div>

    <div class="grid grid-cols-4 gap-4">
      <Card v-for="note in notes" :key="note.id" type="note" :note="note" :tribe="tribe" view="tribe"/>
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
    tribe: {
      type: Object
    },
    notes: {
      type: Array
    },
    users: {
      type: Array
    },
    archived: {
      type: Number
    },
    inbox: {
      type: Number
    }
  }
}
</script>
