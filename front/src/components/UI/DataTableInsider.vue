<template>
  <v-data-table :headers="headers" :items="items" hide-default-footer>
    <template v-slot:top>
      <slot name="top"></slot>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <v-icon
        color="#5abf7a"
        class="mr-2"
        @click="onClickEdit(item)"
        size="26"
      >
        mdi-pencil-circle-outline
      </v-icon>
      <v-icon
        color="#be5b59"
        @click="onClickDelete(item)"
        size="26"
      >
        mdi-trash-can-outline
      </v-icon>
    </template>
  </v-data-table>
</template>
<script>
export default {
  methods: {
    async onClickEdit(item) {
      this.$emit('onClickEdit', item);
    },
    async onClickDelete(item) {
      this.$emit('onClickDelete', item);
    }
  },
  props: {
    headers: {
      type: Array,
      default: () => [],
    },
    items: {
      type: Array,
      default: () => [],
    },
    edit: {
      type: Function,
      default: () => {},
    },
    deleteAction: {
      type: Function,
      default: () => {},
    },
  },
};
</script>
