<template>
  <v-menu
    left
    nudge-bottom="14"
    origin="center center"
    transition="scale-transition"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-icon size="22" color="black" v-bind="attrs" v-on="on">
        mdi-dots-vertical</v-icon
      >
    </template>
    <v-list dense>
      <!-- Profile -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="#18bf93" size="22"> mdi-check-circle-outline </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="atender(idUser)"
            >Atendido</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <!-- Settings -->
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="#bb153c" size="18"> mdi-block-helper </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="naoAtender(idUser)"
            >Não Atendido</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="grey-black" size="18"> mdi-printer-settings </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="visualizar(idUser)"
            >Imprimir</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list-item link>
        <v-list-item-icon class="me-2">
          <v-icon color="brown" size="18"> mdi-file-upload </v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title @click="visualizar(idUser)"
            >Comprovante</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import store from "../../modules/programacao/_store";
import Api from "@/api";
export default {
  props: ["idUser"],
  data() {
    return {};
  },
  beforeCreate() {
    const STORE_PROGRAMACAO = "$_programacao";
    if (!(STORE_PROGRAMACAO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PROGRAMACAO, store);
  },
  mounted() {},
  methods: {
    ...mapActions({
      actionAtender: "$_programacao/atender",
      actionNaoAtender: "$_programacao/naoAtender",
    }),
    async atender(id) {
      const result = await this.actionAtender(id);
      if (result.status === 200) {
        this.$root.$emit("reloadIndex");
        Swal.message("Atentido!");
      }
    },
    async naoAtender(id) {
     const result = await this.actionNaoAtender(id);
      if (result.status === 200) {
        this.$root.$emit("reloadIndex");
        Swal.message("Não Atentido!");
      }
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
};
</script>
