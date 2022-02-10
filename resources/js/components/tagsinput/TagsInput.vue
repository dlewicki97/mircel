<template>
  <v-combobox v-model="model" :hide-no-data="!search" :search-input.sync="search" hide-selected label="Tagi" multiple small-chips append-icon="" >
    <template v-slot:selection="{ attrs, item, parent, selected }">
      <v-chip v-bind="attrs" :color="`primary lighten-3`" :input-value="selected" label small >
        <span class="pr-2">
          {{ item.text }}
        </span>
        <v-icon small @click="deleteTag(item)" >mdi-close</v-icon>
      </v-chip>
    </template>
  </v-combobox>
</template>

<script>
  import axios from 'axios'

  export default {
    props: ['tags'],
    data: () => ({
      activator: null,
      attach: null,
      editing: null,
      index: -1,
      menu: false,
      model: [],
      items: [],
      x: 0,
      search: null,
      y: 0,
    }),
    methods: {
      deleteTag(item) {
        this.model.splice(this.model.indexOf(item), 1);
        if(item.id) axios.delete(`/api/news_tags/delete/${item.id}`);
      }
    },

    watch: {
      tags() {
        if(this.tags) this.model = this.tags;
      },
      model (val, prev) {
        if (val.length === prev.length) return

          this.model = val.map(v => {
            if (typeof v === 'string') {
              v = {
                text: v
              }

            }

            return v
          })
        this.$emit('tags', this.model);
      },
    },
  }
</script>