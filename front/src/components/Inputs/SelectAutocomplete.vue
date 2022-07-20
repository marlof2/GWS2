<template>
  <div>
    <span>
      {{ label }}<span v-if="required" class="red--text text-h6">*</span></span
    >
    <v-autocomplete
      :items="items"
      :item-text="itemText"
      :item-value="itemValue"
      :rules="rules"
      v-model="localValue"
      dense
      outlined
      clearable
      :disabled="disabled"
    ></v-autocomplete>
  </div>
</template>
<script>
export default {
  name: "SelectAutocomplete",
  props: {
    label: {
      type: String,
      default: "",
    },
    items: {
      type: [Array, Object],
      default: () => [],
    },
    itemText: {
      type: String,
      default: "",
    },
    itemValue: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    required: {
      type: Boolean,
      default: false,
    },
    value: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
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
<style></style>