<template>
  <v-btn
    @click="click"
    class="mx-2"
    v-bind="vBind"
    v-on="on"
    color="#10A375"
    fab
    x-small
    :disabled="disabled"
  >
    <v-icon>mdi-plus</v-icon>
  </v-btn>
</template>
<script>
export default {
  props: {
    vBind: null,
    on: null,
    click: {
      type: Function,
      default: () => {},
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
