<template>
  <v-menu
    left
    nudge-bottom="14"
    origin="center center"
    transition="scale-transition"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-icon size="22" color="black" v-bind="attrs" v-on="on"> mdi-dots-vertical</v-icon>
    </template>
    <v-list dense>
      <!-- Profile -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="info" size="22"> mdi-pencil </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="editar(idUser)">Outra Acão</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <!-- Settings -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="warning" size="22"> mdi-eye </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="visualizar(idUser)"
            >Outra Acão</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Api from "@/api";
export default {
  props: ["idUser"],
  data() {
    return {};
  },
  mounted() {
  },
  methods: {
    ...mapActions({}),
    editar(id) {
      return this.$router.push({
        path: this.$router.currentRoute.path + `/editar/${id}`,
      });
    },
    visualizar(id) {
      return this.$router.push({
        path: this.$router.currentRoute.path + `/visualizar/${id}`,
      });
    },
  },
  computed: {
    ...mapGetters({}),
  },
  beforeCreate() {},
};
</script>
