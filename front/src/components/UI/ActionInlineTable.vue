<template>
  <span class="icons">
    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-permissions="permissions.alterar"
          @click="editar(item.id)"
          text
          icon
          color="#5abf7a"
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
          color="#468bd9"
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

export default {
  props: {
    item: null,
    itemToExclude: {
      type: String,
      default: "",
    },
    permissions: {
      type: Object,
      default: () => {},
    },
  },
  mounted() {},
  methods: {
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
          title: `Tem certeza que deseja apagar <b>${
            this.item[`${this.itemToExclude}`]
          }</b>?`,
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
              `${process.env.VUE_APP_URL_API_CADASTRO_BASICO}${pathRoute}`,
              id
            );
            if (!response) return false;
            this.$swal.fire({
              title: response.data.success,
              icon: "success",
            });
            this.$root.$emit("reloadDelete");
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
