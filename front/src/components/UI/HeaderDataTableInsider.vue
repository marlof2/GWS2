<template>
  <v-toolbar class="pa-0" flat>
    <v-toolbar-title
      ><strong>{{ title }}</strong></v-toolbar-title
    >
    <v-divider class="mx-4" inset vertical></v-divider>
    <v-spacer></v-spacer>
    <span class="icons">
      <template>
        <AddButtonIcon
          v-if="hideBtnAdd"
          v-permissions="permissions ? permissions.incluirInseder : ''"
          :click="addButtonClick"
          :disabled="disabled"
        />
      </template>
    </span>
  </v-toolbar>
</template>

<script>
import AddButtonIcon from "./AddButonIcon.vue";

export default {
  props: {
    title: {
      type: String,
      default: "",
    },
    addButtonClick: {
      type: Function,
      default: () => {},
    },
    permissions: {
      type: Object,
      default: () => {},
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    hideBtnAdd: {
      type: Boolean,
      default: true,
    },
  },

  components: {
    AddButtonIcon,
  },
  mounted() {},
};
</script>

<style></style>
