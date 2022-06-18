<template>
  <v-btn class="mx-2" v-bind="vBind" v-on="on" color="#10A375" dark fab x-small>
    <v-icon>mdi-plus</v-icon>
  </v-btn>
</template>
<script>
export default {
  props: {
    vBind: null,
    on: null,
  }
}
</script>
