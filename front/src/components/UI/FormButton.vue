<template>
  <v-btn
    :min-width="small ? '' : '150px'"
    :min-height="small ? '' : '42px'"
    class="py-2 label"
    v-on="$listeners"
    :dark="dark"
    :style="{ background: background }"
    :loading="isLoading"
    >{{ label }}</v-btn
  >
</template>
<script>
export default {
  props: {
    background: String,
    label: String,
    dark: Boolean,
    click: Function,
    isLoading: Boolean,
    small:Boolean
  },
};
</script>

<style scoped>
.label {
  font-size: 12pt;
}
</style>
