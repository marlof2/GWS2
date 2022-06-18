<template>
  <div>
    <span>
      {{ label }}<span v-if="required" class="red--text text-h6"> *</span></span
    >
    <v-menu
      ref="datePickerMenu"
      v-model="datePickerMenu"
      :close-on-content-click="true"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="auto"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="dateFormatted"
          hint="DD/MM/AAAA"
          persistent-hint
          prepend-inner-icon="mdi-calendar"
          v-bind="attrs"
          v-on="on"
          clearable
          outlined
          dense
          :rules="rules"
          :disabled="disabled"
        ></v-text-field>
      </template>
      <v-date-picker
        :max="maxDate"
        :min="minDate"
        no-title
        v-model="localValue"
        @input="datePickerMenu = false"
        :disabled="disabled"
      ></v-date-picker>
    </v-menu>
  </div>
</template>
<script>
import dateFilter from "../../filters/formatDate";
export default {
  name: "DatePicker",
  props: {
    date: {
      type: [Date, String],
      default: null,
    },
    value: {
      type: [String, Date],
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
    maxDate: {
      type: [String, Date],
      default: null,
    },
    minDate: {
      type: [String, Date],
      default: null,
    },
    label: {
      type: String,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      datePickerMenu: false,
      dateFormatted: !this.value
        ? null
        : dateFilter.formatDate(dateFilter.newDate),
    };
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
  watch: {
    date(val) {
      this.dateFormatted = dateFilter.formatDate(val);
    },
  },
};
</script>
