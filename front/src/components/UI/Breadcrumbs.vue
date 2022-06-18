<template>
  <v-breadcrumbs :items="breadcrumbs" class="px-1 py-1"></v-breadcrumbs>
</template>

<script>
export default {
  props: {
    breadcrumbs: [],
  }
}
</script>
