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
    <div v-if="verifyRouteProgramation()">
      <v-list dense>
        <!-- Profile -->
        <v-list-item link>
          <v-list-item-icon class="me-2">
            <v-icon color="#18bf93" size="22">
              mdi-check-circle-outline
            </v-icon>
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
            <v-list-item-title @click="imprimir(idUser)"
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
            <v-list-item-title @click="comprovante(idUser)"
              >Comprovante</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </div>
    <div v-if="verifyRouteUser()">
      <v-list dense>
        <!-- Profile -->
        <v-list-item link>
          <v-list-item-icon class="me-2">
            <v-icon color="grey-dark" size="22"> mdi-account-lock </v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title @click="gerenciar(idUser)"
              >Gerenciar Permissões</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </div>
  </v-menu>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import store from "../../modules/deleteGlobal/_store";
export default {
  props: ["idUser"],
  data() {
    return {};
  },
  beforeCreate() {
    const STORE_DELETE = "$_deleteGlobal";
    if (!(STORE_DELETE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_DELETE, store);
    const STORE_PROGRAMACAO = "$_programacao";
    if (!(STORE_PROGRAMACAO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PROGRAMACAO, store);
  },
  mounted() {},
  methods: {
    ...mapActions({
      reloadIndex: "$_deleteGlobal/reloadIndex",
      flagAtender: "$_programacao/flagAtender",
      flagNaoAtender: "$_programacao/flagNaoAtender",
      flagImprimir: "$_programacao/flagImprimir",
      flagComprovante: "$_programacao/flagComprovante",
    }),
    verifyRouteProgramation() {
      return this.$router.currentRoute.name == "programacao" ? true : false;
    },
    verifyRouteUser() {
      return this.$router.currentRoute.name === "users" ? true : false;
    },
    async gerenciar(id) {
      // const result = await this.actionAtender(id);
      // if (result.status === 200) {
      // }
      Swal.message("Em andamento!");
    },
    async comprovante(id) {
      await this.flagComprovante({ id: id, flag: true });
    },
    async imprimir(id) {
      await this.flagImprimir({ id: id, flag: true });
    },
    async atender(id) {
      await this.flagAtender({ id: id, flag: true });
    },
    async naoAtender(id) {
      await this.flagNaoAtender({ id: id, flag: true });
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
