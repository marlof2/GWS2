<template>
  <Vcol :col="cols">
    <h5>{{ label }}</h5>
    <span>{{ data ? data : "" }}</span>
    <span v-if="data === false">Não</span>
    <span v-if="data === true">Sim</span>
  </Vcol>
</template>
<script>
import Vcol from './Vcol.vue';

export default {
  components: {
    Vcol,
  },
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
