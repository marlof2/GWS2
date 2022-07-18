<template>
  <span class="icons">
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-permissions="permissions.alterar"
          @click="editar(item.id)"
          text
          icon
          color="#468bd9"
          size="22"
        >
          <v-icon v-on="on" v-bind="attrs">mdi-square-edit-outline</v-icon>
        </v-btn>
      </template>
      <span>Editar</span>
    </v-tooltip>
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-permissions="permissions.visualizar"
          @click="visualizar(item.id)"
          text
          icon
          color="grey-black"
          size="22"
        >
          <v-icon v-on="on" v-bind="attrs">mdi-eye-outline</v-icon>
        </v-btn>
      </template>
      <span>Visualizar</span>
    </v-tooltip>
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-permissions="permissions.excluir"
          @click="excluir(item.id)"
          text
          icon
          color="#be5b59"
          size="22"
        >
          <v-icon v-on="on" v-bind="attrs">mdi-delete-outline</v-icon>
        </v-btn>
      </template>
      <span>Excluir</span>
    </v-tooltip>
  </span>
</template>

<script>
import Api from "@/api";
import store from "../../modules/deleteGlobal/_store";
import { mapActions } from "vuex";

export default {
  props: {
    item: null,
    permissions: {
      type: Object,
      default: () => {},
    },
  },
  beforeCreate() {
    const STORE_DELETE = "$_deleteGlobal";
    if (!(STORE_DELETE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_DELETE, store);
  },
  mounted() {},
  methods: {
    ...mapActions({
      reloadIndex: "$_deleteGlobal/reloadIndex",
    }),
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
    async excluir(id) {
      const pathRoute = this.$router.currentRoute.name;
      this.$swal
        .fire({
          title: `Tem certeza que deseja apagar?`,
          text: "Esta ação não poderá ser desfeita!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#ff0000",
          confirmButtonText: "Excluir",
          cancelButtonText: "Cancelar",
        })
        .then(async (result) => {
          if (result.isConfirmed) {
            const response = await Api.delete(
              `${process.env.VUE_APP_URL_API}${pathRoute}`,
              id
            );
            if (!response) return false;
            this.$swal.fire({
              title: "Deletado com Sucesso!",
              icon: "success",
            });
            await this.reloadIndex(true);
            this.$root.$emit("resetPage");
          }
        });
    },
  },
};
</script>
<style scoped>
.swal2-styled.swal2-confirm {
  background-color: #ff0000 !important;
}
</style>
