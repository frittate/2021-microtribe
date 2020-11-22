<template>
  <button
    class="hover:bg-gray-300 text-gray-800 font-bold py-2 px-4"
    :class="{ 'is-active': active }"
    @click="$emit('click')"
  >
    <component :is="`${name}-icon`" v-if="icon" />
    <template v-else>
      {{ name }}
    </template>
  </button>
</template>

<script>
import Icon from '@/components/atoms/Icon.vue'
export default {
  name: 'EditorButton',
  components: {
    Icon
  },
  props: {
    active: { type: Boolean, default: () => false },
    icon: { type: Boolean, default: () => false },
    name: { type: String, default: () => 'P' }
  }
}
</script>

<style>
  button.is-active {
    @apply bg-gray-400;
  }
</style>
