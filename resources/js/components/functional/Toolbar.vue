<template>
  <div class="fixed bottom-0 left-0 h-14 bg-gray-700 w-screen">
    <div class="lg:max-w-7xl m-auto flex h-full">
      <div v-if="showFilters" class="flex h-full">
        <div role="button" class="relative flex flex-col py-2 px-12 border-r border-gray-600 hover:bg-gray-800 items-center justify-center cursor-pointer w-48" tabindex="0" @focus="toggleSortingOverlay" @focusout="toggleSortingOverlay" ref="sortButton">
          <p class="rounded bg-gray-800 p-1 block font-bold text-white text-tiny uppercase">{{ sortingAttribute }}</p>
          <div v-if="showSort" class="absolute w-full lg:w-40 bg-gray-700 transform -translate-y-32 rounded">
            <ul class="flex flex-col items-center p-2 space-y-2">
              <li v-for="attribute in availableSorting" :key="attribute" v-show="attribute !== sortingAttribute" class="sort-item" @click="setSortingAttribute(attribute)">{{ attribute }}</li>
            </ul>
          </div>
          <p class="text-tiny text-white">sorting</p>
        </div>
        <div class="flex flex-col py-2 px-8 items-center justify-center rounded-sm bg-gray-800">
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
  data() {
    return {
      availableSorting: [
        'newest',
        'oldest',
        'title',
        'lastChanged'
      ],
      sortingAttribute: 'newest',
      showSort: false
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
        case 'tribes':
          return 'make a new tribe'
        case 'noteEditor':
          return 'save changes'
        case 'tribes.create':
          return 'create new tribe'
        case 'tribes.edit':
          return 'save changes'
        default:
          break;
      }
    }
  },
  methods: {
     toggleSortingOverlay() {
       this.showSort = !this.showSort
    },
    setSortingAttribute(attribute){
      this.sortingAttribute = attribute
      this.$emit('changeSort', attribute)
      this.$refs.sortButton.blur()
    }
  },
}
</script>

<style scoped>
  .sort-item {
    @apply text-white text-sm uppercase p-2 rounded-sm bg-gray-800 w-full text-center;
  }
</style>
