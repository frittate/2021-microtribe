<template>
  <i class="mdi" :class="iconName" aria-hidden="true" />
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default () {
        return ''
      }
    }
  },
  computed: {
    iconName () {
      return `mdi-${this.name}`
    }
  }
}
</script>

<style>

</style>
