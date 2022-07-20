<template>
  <v-col>
    <h4 class="mt-4">{{ label }}</h4>
    <span>{{ data ? data : "Sem Informação" }}</span>
    <span v-if="data === false">Não</span>
    <span v-if="data === true">Sim</span>
  </v-col>
</template>
<script>
export default {
  components: {},
  props: {
    label: {
      type: String,
      default: "",
    },
    data: {
      type: [String, Boolean, Number, Function, Date, Object],
      default: null,
    },
    cols: {
      type: Number,
      default: 12,
    },
  },
};
</script>
<style  scoped>
he {
  font-weight: normal;
}
</style>
