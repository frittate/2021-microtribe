<template>
  <div class="fixed bottom-0 left-0 h-14 bg-gray-700 w-screen">
    <div class="lg:max-w-7xl m-auto flex h-full">
      <div v-if="showFilters" class="flex h-full">
        <div class="flex flex-col py-2 px-12 border-r border-gray-600 items-center justify-center">
          <p class="block font-bold text-white text-tiny">NEWEST</p>
          <p class="text-tiny text-white">sorting</p>
        </div>
        <div class="flex flex-col py-2 px-8 items-center justify-center">
          <p class="block font-bold text-white text-xl leading-4">
            <view-grid-icon />
          </p>
          <p class="text-tiny text-white">grid view</p>
        </div>
        <div class="flex flex-col py-2 px-8 items-center justify-center border-r border-gray-600">
          <p class="block font-bold text-white text-xl leading-4">
            <view-list-icon />
          </p>
          <p class="text-tiny text-white">grid view</p>
        </div>
      </div>
      <button v-if="(showMainAction && page === 'noteEditor') || (showMainAction && page === 'tribes.create') " class="ml-auto h-full px-6 py-3 bg-indigo-500 hover:bg-indigo-600 flex items-center justify-center font-bold text-xs text-white" @click="$emit('main-action')">{{ mainActionText }}</button>
      <inertia-link v-else-if="showMainAction" :href="mainAction" class="ml-auto h-full px-6 py-3 bg-indigo-500 hover:bg-indigo-600 flex items-center justify-center font-bold text-xs text-white">{{ mainActionText }}</inertia-link>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: {
    page: {
      type: String,
      default: () => ''
    },
    showMainAction: {
      type: Boolean,
      default: () => true
    },
    showFilters: {
      type: Boolean,
      default: () => false
    }
  },
  computed: {
    mainAction() {
      if (this.page === 'notes') {
        return route('notes.create')
      } else if (this.page === 'tribes') {
        return route('tribes.create')
      }
      return ''
    },
    mainActionText() {
      switch (this.page) {
        case 'notes':
          return 'add a new entry'
          break;
        case 'tribes':
          return 'make a new tribe'
          break
        case 'noteEditor':
          return 'save changes'
        case 'tribeEditor':
          return 'save changes'
        default:
          break;
      }
    }
  },
}
</script>
