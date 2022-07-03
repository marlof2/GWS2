<template>
  <v-toolbar class="pa-0" flat>
    <v-toolbar-title><strong>{{title}}</strong></v-toolbar-title>
    <v-divider class="mx-4" inset vertical></v-divider>
    <v-spacer></v-spacer>
    <AddButtonIcon :click="addButtonClick"/>
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
  },
  components: {
    AddButtonIcon,
  },
};
</script>

<style></style>
