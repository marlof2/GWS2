<template>
  <v-navigation-drawer v-model="localValue" right absolute temporary>
    <v-row align="center" justify="center">
      <h3>Filtro Avançado</h3>
    </v-row>
    <v-divider class="mt-1 mb-2"></v-divider>
    <slot></slot>
  </v-navigation-drawer>
</template>
<script>
export default {
  props: {
    value: Boolean
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>

<style scoped></style>
