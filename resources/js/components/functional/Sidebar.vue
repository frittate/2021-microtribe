<template>
  <div class="md:col-span-4">
    <div class=" flex flex-col">
      <div class="border-t border-gray-200 p-2">
        <h5 class="text-tiny font-medium text-gray-500 mb-2 uppercase">history</h5>
        <p class="text-tiny text-gray-400">{{ note.created_at }}</p>
      </div>
      <div class="border-t border-gray-200 p-2">
        <h5 class="text-tiny font-medium text-gray-500 mb-2 uppercase">tags</h5>
        <p class="text-tiny text-gray-400">tbd</p>
      </div>
      <div class="border-t border-gray-200 p-2">
        <h5 class="text-tiny font-medium text-gray-500 mb-2 uppercase">shared to tribes</h5>
        <div class="flex items-center">
          <inertia-link v-for="tribe in tribes" :href="route('tribes.single', tribe.uuid)" :key="tribe.id" class="h-8 w-8 rounded-full overflow-hidden mr-3">
            <img :src="tribe.photo_path" alt="" />
          </inertia-link>
          <div class="rounded-full h-8 w-8 bg-indigo-500 hover:bg-indigo-700 flex justify-center items-center text-white cursor-pointer font-bold" role="button" @click="openTribeModal">
            +
          </div>
        </div>
      </div>
      <div class="border-t border-b border-gray-200 p-2">
        <h5 class="text-tiny font-medium text-gray-500 mb-2 uppercase">comments and interactions</h5>
        <p class="text-tiny text-gray-400">tbd</p>
      </div>
    </div>
    <div>
      <modal name="my-first-modal">
        <p>shared to:</p>
        <ul v-if="tribes.length">
          <li v-for="tribe in tribes" :key="tribe.id">
            {{ tribe }}
          </li>
        </ul>
        <p v-else>This has not been shared to a tribe yet.</p>
        <!-- <select name="" id="" v-model="form.utribe">
          <option
            v-for="utribe in userTribes"
            :key="utribe.uuid"
            :value="utribe.uuid"
          >
            {{ utribe.name }}
          </option>
        </select>
        <button @click="save">Save</button> -->
      </modal>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    note: {
      type: Object,
      required: true
    },
    tribes: {
      type: Array,
      default: () => []
    }
  },
  methods: {
    openTribeModal() {
      this.$modal.show('my-first-modal');
    },
    hideTribeModal() {
      this.$modal.hide('my-first-modal');
    }
  },
}
</script>

<style>

</style>