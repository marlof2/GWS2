<template>
  <div>
    <span>
      {{ label }}<span v-if="required" class="red--text text-h6">*</span></span
    >
    <span v-if="pagination">
      <div class="mb-1"></div>
    </span>
    <v-autocomplete
      :items="items"
      :item-value="itemValue"
      :rules="rules"
      v-model="localValue"
      dense
      outlined
      clearable
    >
      <template slot="selection" slot-scope="data">
        {{ itemValue ? data.item[itemValue] : data.item }}
      </template>
      <template slot="item" slot-scope="data">
        <p v-if="fields.length > 0">
          <span v-for="field in fields" :key="field">
            <span v-if="field === 'nome'">
              <b>{{ data.item[`${field}`] }}</b>
            </span>
            <span v-else>
              <b>{{ field | uppercase }}:</b>&nbsp;{{ data.item[`${field}`] }}
            </span>
            <br />
          </span>
        </p>
        <span v-else>
          {{ data.item }}
        </span>
      </template>
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
    fields: {
      type: Array,
      default: [],
    },
    value: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    pagination: {
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
