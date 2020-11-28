<template>
  <inertia-link
    v-if="type === 'note'"
    :href="cardLink"
    class="card bg-white border border-gray-200 rounded-sm p-5 flex flex-col hover:shadow-sm hover:border-blue-200"
  >
    <div v-if="view === 'notes'">
      <p class="text-xs text-gray-400 mb-1">{{ createdFromNow }}</p>
      <h2 class="text-lg font-medium text-gray-800 mb-2">{{ note.title }}</h2>
      <p class="text-base text-gray-600 mb-5">{{ note.parsedContent }}</p>
    </div>

    <div v-else-if="view === 'tribe'">
      <div class="flex items-center mb-4">
        <img :src="note.user.profile_photo_url" alt="" class="rounded-full h-10 w-10 inline-flex mr-2">
        <div>
          <p class="text-tiny text-gray-400 mb-1">{{ dateFormatted }} &middot; {{ createdFromNow }} &middot; {{ updatedFromNow }}</p>
          <p class="text-gray-700 text-base font-medium">{{ username }}</p>
        </div>
      </div>
      <h2 class="text-lg font-medium text-gray-800 mb-2">{{ note.title }}</h2>
      <p class="text-base text-gray-600 mb-5">{{ note.parsedContent }}</p>
    </div>
  </inertia-link>
  <inertia-link
    v-else-if="type === 'tribe'"
    :href="`/tribes/${tribe.uuid}/view`"
    class="card bg-white border border-gray-200 rounded-sm p-5 flex flex-col hover:shadow-sm hover:border-blue-200 items-center">
    <img :src="tribe.photo_path" alt="" class="rounded-full h-24 w-24 border-gray-200 mb-3">
    <p class="text-lg text-gray-800 mb-2">{{ tribe.name }}</p>
  </inertia-link>
</template>

<script>
import relativeTime from 'dayjs/plugin/relativeTime'
import dayjs from 'dayjs'

dayjs.extend(relativeTime)

export default {
  components: {
  },
  props: {
    type: {
      type: String,
      required: true
    },
    note: {
      type: Object
    },
    tribe: {
      type: Object
    },
    view: {
      type: String,
      default: () => 'notes'
    }
  },
  mounted() {
  },
  computed: {
    createdFromNow() {
      if (this.type !== 'note') {
        return ''
      }
      return dayjs(dayjs(this.note.created_at)).fromNow()
    },
    updatedFromNow() {
      if (this.type !== 'note') {
        return ''
      }
      return dayjs(dayjs(this.note.updated_at)).fromNow()
    },
    dateFormatted() {
      return dayjs(this.note.created_at).format('YYYY-MM-DD')
    },
    cardLink() {
      if (this.view === 'notes') {
        return route('notes.single', this.note.uuid)
      }

      return route('tribes.note', [this.tribe.uuid, this.note.uuid])
    },
    username() {
      return this.note.user.id === this.$page.props.user.id ? 'You' : this.note.user.name
    }
  },
}
</script>

<style>

</style>