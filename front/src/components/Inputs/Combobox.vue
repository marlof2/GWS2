<template>
  <div>
    <span>
      {{ label }}<span v-if="required" class="red--text text-h6">*</span></span
    >
    <v-combobox
      v-model="localValue"
      :rules="rules"
      :items="items"
      dense
      outlined
      clearable
      multiple
      :item-text="itemText"
    ></v-combobox>
  </div>
</template>
<script>
export default {
  name: "Combobox",
  props: {
    required: {
      type: Boolean,
      default: false,
    },
    rules: {
      type: Array,
     default: () => [],
    },
    value: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    items: {
      type: Array,
      default: [],
    },
    label: {
      type: String,
      default: "",
    },
    itemText: {
      type: String,
      default: "",
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
