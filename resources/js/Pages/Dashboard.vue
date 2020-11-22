<template>
  <app-layout>
    <template #currentPageNav>
			<inertia-link :href="route('dashboard')"> Home </inertia-link>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <inertia-link class="hover:underline" :href="route('notes.all')"> Notes </inertia-link>
        </div>
      </div>
    </div>

    <inertia-link
      :href="route('login')"
      class="text-sm text-gray-700 underline"
    >
      Login
    </inertia-link>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
};
</script>
