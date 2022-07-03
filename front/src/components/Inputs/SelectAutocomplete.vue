<template>
  <div>
    <label>
      {{ label }}<span v-if="required" class="red--text text-h6">*</span></label
    >
    <v-autocomplete
      :items="items"
      :item-value="itemValue"
      :rules="rules"
      v-model="localValue"
      dense
      outlined
      clearable
    >
    </v-autocomplete>
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
      type: Array,
      default: [],
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
