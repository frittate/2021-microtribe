<template>
  <app-layout>
    <Toolbar page="tribes.create" @mainAction="save" />

    <template #currentPageNav>
      <inertia-link class="hover:underline" :href="route('dashboard')"> Home </inertia-link>
        <span class="px-2">&rarr;</span>
      <inertia-link class="hover:underline" :href="route('tribes.all')"> Tribes </inertia-link>
        <span class="px-2">&rarr;</span>
      <p class="underline">{{ tribe.name }}</p>
    </template>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto">
        <form>
          <div>
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Create new tribe
              </h3>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
              <div class="sm:col-span-4">
                <label for="tribeName" class="block text-sm font-medium leading-5 text-gray-700">
                  Tribe name
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                    app.microtribes.com/
                  </span>
                  <input id="tribeName" v-model="form.name" class="flex-1 form-input block w-full min-w-0 rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
              </div>

              <div class="sm:col-span-6">
                <label for="about" class="block text-sm font-medium leading-5 text-gray-700">
                  About
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <textarea id="about" rows="3" v-model="form.description" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500">What is the main purpose of this tribe?</p>
              </div>

              <div class="sm:col-span-4">
                <label for="photo_url" class="block text-sm font-medium leading-5 text-gray-700">
                  Background image
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="photo_url" type="url" v-model="form.photo_url" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
              </div>
            </div>
          </div>

          <div class="mt-8 border-t border-gray-200 pt-8">
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Members
              </h3>
              <p class="mt-1 text-sm leading-5 text-gray-500">
                Invite your friends by email!
              </p>
            </div>

            <div class="sm:col-span-2">
              <label for="city" class="block text-sm font-medium leading-5 text-gray-700">
                City
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input id="city" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
              </div>
            </div>

          </div>
          <div class="mt-8 border-t border-gray-200 pt-8">
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Settings
              </h3>
              <p class="mt-1 text-sm leading-5 text-gray-500">
               Some defaults on how the new tribe will work.
              </p>
            </div>
            <div class="mt-6">
              <div class="relative flex items-start">
                <div class="flex items-center h-5">
                  <input id="has_inbox" v-model="this.form.has_inbox" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                </div>
                <div class="ml-3 text-sm leading-5">
                  <label for="has_inbox" class="font-medium text-gray-700">Use inbox</label>
                  <p class="text-gray-500">All notes from tribe members will need approval before appearing in the main view.</p>
                </div>
              </div>
              <div class="relative flex items-start mt-6">
                <div class="flex items-center h-5">
                  <input id="has_archive" v-model="this.form.has_archive" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                </div>
                <div class="ml-3 text-sm leading-5">
                  <label for="has_archive" class="font-medium text-gray-700">Use archive</label>
                  <p class="text-gray-500">Notes can be moved to the archive, where no more comments can be added.</p>
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="votes_for_approve" class="block text-sm font-medium leading-5 text-gray-700">
                  Tribe members to <strong>approve</strong> a new post
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="votes_for_approve" type="number" min="0" max="5" v-model="form.votes_for_approve" class="form-input block transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="votes_for_archive" class="block text-sm font-medium leading-5 text-gray-700">
                  Tribe members to <strong>archive</strong> a post
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="votes_for_archive" type="number" min="0" max="5" v-model="form.votes_for_archive" class="form-input block transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="votes_for_delete" class="block text-sm font-medium leading-5 text-gray-700">
                  Tribe members to <strong>delete</strong> a post
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input id="votes_for_delete" type="number" min="0" max="5" v-model="form.votes_for_delete" class="form-input block transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Toolbar from '@/components/functional/Toolbar'

export default {
  components: {
    AppLayout,
    Toolbar
  },
  props: {
    tribe: {
      type: Object
    },
  },
  data() {
    return {
      form: {
        name: '',
        description: '',
        photo_url: '',
        votes_for_approve: null,
        votes_for_archive: null,
        votes_for_delete: null,
        has_inbox: null,
        has_archive: null
      }
    }
  },
  mounted () {
    this.form.name = this.tribe.name;
    for (const [key, value] of Object.entries(this.tribe)) {
      if (key in this.form) {
        this.form[key] = value
      }
    }
  },
  methods: {
    save() {
      console.log('save');
    }
  },
}
</script>
