<template>
    <div class="min-h-screen bg-gray-50 relative">
      <nav class="flex justify-between items-center bg-white border-b border-gray-200 px-4 py-6">
        <div class="flex items-center">
          <slot name="currentPageNav"></slot>
        </div>
        <div class="flex items-center">
          <p class="text-gray-600 pr-4">
            Settings tbd
          </p>
          <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
          </button>
        </div>
      </nav>
      <slot name="topContent"></slot>
      <main class="lg:max-w-7xl m-auto py-6">
        <slot></slot>
      </main>
    </div>
</template>

<script>

export default {
  components: {
  },
  props: {
    hasToolbar: {
      type: Boolean,
      default: () => false
    }
  },
  data() {
    return {
      showingNavigationDropdown: false
    };
  },
  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    }
  }
}
</script>
