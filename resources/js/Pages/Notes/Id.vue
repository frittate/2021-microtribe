<template>
  <app-layout>
    <Toolbar page="noteEditor" show-main-action @main-action="save" />
    <template #currentPageNav>
      <inertia-link class="hover:underline" :href="route('dashboard')"> Home </inertia-link>
        <span class="px-2">&rarr;</span>
      <inertia-link class="hover:underline" :href="route('notes.all')"> Notes </inertia-link>
        <span class="px-2">&rarr;</span>
      <p class="underline">{{ note.title }}</p>
    </template>

    <template #topContent>
      <div class="w-screen bg-gray-50">
        <div class="lg:max-w-7xl m-auto pt-6">
          <inertia-link class="flex text-gray-600" :href="route('notes.all')">
            <chevron-left-icon />
            Back
          </inertia-link>
        </div>
      </div>
    </template>
    <div>
      <div class="flex flex-col md:grid md:grid-cols-12">
        <div class="md:col-span-8 bg-white">
          <div class="flex items-center pr-2">
            <h3
              class="editable py-6 px-2 text-lg font-medium text-gray-800 w-full"
              ref="editable"
              @input="onLiveEdit"
              @blur="endEdit"
              :contenteditable="editTitleEnabled">
            {{ note.title }}
            </h3>
            <div class="ml-auto text-gray-400 cursor-pointer">
              <check-circle-icon v-if="editTitleEnabled" @click="endEdit" />
              <pencil-icon v-else @click="enableEdit" />
            </div>
          </div>
          <EditorWrapper :loaded-content="loadedContent" @edit="updateDocument" />
        </div>
        <Sidebar :note="note" :tribes="tribes" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import EditorWrapper from '@/components/functional/editor/EditorWrapper.vue'
import Sidebar from '@/components/functional/Sidebar.vue'
import Toolbar from '@/components/functional/Toolbar.vue'

export default {
  components: {
    AppLayout,
    EditorWrapper,
    Sidebar,
    Toolbar
  },
  props: {
    note: Object,
    tribes: Array,
    userTribes: Array,
  },
  data() {
    return {
      form: {
        utribe: '',
        content: '',
        title: ''
      },
      editTitleEnabled: false
    };
  },
  computed: {
    loadedContent() {
      return JSON.parse(this.note.content)
    }
  },
  mounted() {
    this.form.title = this.note.title
  },
  methods: {
    save() {
      this.$inertia.put(this.route("notes.update", this.note.id), this.form, {
        onSuccess: () => {
          this.form.utribe = "";
        },
      });
    },
    updateDocument(e) {
      this.form.content = e
    },
    enableEdit() {
      this.editTitleEnabled = true
      this.$nextTick(() => {
        this.$refs.editable.focus()
      })
    },
    endEdit() {
      this.editTitleEnabled = false
    },
    onLiveEdit(e) {
      this.form.title = e.target.innerText.trim();
    }
  }
};
</script>

<style>
</style>