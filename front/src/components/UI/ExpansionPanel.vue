<template>
  <div>
    <v-expansion-panels v-model="open" focusable :readonly="readOnly">
      <v-expansion-panel>
        <v-expansion-panel-header>
          {{ title }}
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <slot></slot>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    readOnly: Boolean,
    open: Number,
  },
};
</script>
<style></style>
