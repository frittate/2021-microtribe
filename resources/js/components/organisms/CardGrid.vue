<template>
  <div class="grid grid-cols-4 gap-4">
    <Card v-for="note in sortedCards" :key="note.id" type="note" :note="note" :tribe="tribe" :view="tribe ? 'tribe' : 'notes'"/>
  </div>
</template>

<script>
import Card from '@/components/molecules/Card'

export default {
  components: {
    Card,
  },
  props: {
    cards: {
      type: Array,
      default: () => []
    },
    sort: {
      type: String,
      default: () => 'newest'
    },
    tribe: {
      type: Object,
      default: () => null
    }
  },
  data() {
    return {
      grid: true
    }
  },
  computed: {
    sortedCards() {
      return this.cards.sort((a, b) => {
        if (this.sort === 'title') {
          if (a.title.toLowerCase() < b.title.toLowerCase()) return -1;
          if (a.title.toLowerCase() > b.title.toLowerCase()) return 1;
          return 0;
        }

        if (this.sort === 'newest') {
          if (a.created_at < b.created_at) return 1;
          if (a.created_at > b.created_at) return -1;
          return 0;
        }

        if (this.sort === 'oldest') {
          if (a.created_at < b.created_at) return -1;
          if (a.created_at > b.created_at) return 1;
          return 0;
        }

        if (this.sort === 'lastChanged') {
          if (a.updated_at < b.updated_at) return 1;
          if (a.updated_at > b.updated_at) return -1;
          return 0;
        }
      })
    }
  },
}
</script>
