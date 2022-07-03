<template>
  <div>
    <span
      >{{ label
      }}<span v-if="required" class="red--text text-h6"> *</span></span
    >
    <v-textarea
      v-model="localValue"
      :value="localValue"
      outlined
      :maxlength="maxlength"
      :rows="rows"
      :row-height="rowHeight"
      :counter="maxlength"
      :rules="rules"
    ></v-textarea>
  </div>
</template>
<script>
export default {
  name: "TextArea",
  props: {
    rules: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: "",
    },
    value: {
      type: String,
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
    maxlength: {
      type: Number,
      default: null,
    },
    rows: {
      type: Number,
      default: 0,
    },
    rowHeight: {
      type: Number,
      default: 0,
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
