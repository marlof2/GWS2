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
          v-permissions="permissions ? permissions.incluirInseder : ''"
          :click="addButtonClick"
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
  },
  components: {
    AddButtonIcon,
  },
};
</script>

<style></style>
