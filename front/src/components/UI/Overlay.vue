<template>
  <v-overlay :value="overlay" opacity="0.5">
    <div class="blob">
      <v-img src="../../assets/images/logo.png" />
    </div>
  </v-overlay>
</template>

<script>
export default {
  props: ["overlay"],
  data() {
    return {};
  },
};
</script>

<style scoped>
.blob {
  transform: scale(1);
  animation: pulse linear 1.8s infinite;
}

@keyframes pulse {
	0% { width:276px; }
	50% { width:376px; }
	100% { width:276px; }
}
</style>
