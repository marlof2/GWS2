<template>
  <div class="d-flex flex-grow-1 flex-column">
    <FiltroAvancado v-model="drawer">
      <v-col cols="12" sm="12" md="12">
        <TextField
          v-model="filter.nome"
          label="Nome"
          :maxlength="40"
          v-mask="''"
        />
      </v-col>

      <!-- <v-col cols="12" sm="12" md="12">
        <Select
          v-model="filter.quantidade"
          :itemValue="'id'"
          :itemText="'descricao'"
          :items="['teste']"
          :label="'Porte'"
        />
      </v-col> -->

      <v-row justify="center">
        <FormButton
          :background="this.$colors.dark_green"
          :label="this.$strings.btn_filtrar"
          dark
          @click="filterAdvanced()"
          small
        />
      </v-row>
    </FiltroAvancado>
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Produtos</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2 elevation-0">
      <DataTable
        :headersProp="headers"
        :dataProp="items"
        :lastPageProp="paginate.lastPage"
        :pageProp="paginate.page"
        :itemsPerPageProp="paginate.perPages"
        @handleSearch="search"
        @handlePageChange="handlePageChange"
        @handleDrawer="
          (drawer) => {
            this.drawer = drawer;
          }
        "
        :itemToExclude="'nome'"
        :permissions="permissions"
      />
    </v-card>
  </div>
</template>
<script>
import store from "./_store";
import DataTable from "../../components/UI/DataTable.vue";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import { mapActions, mapGetters } from "vuex";
import { constants } from "./_constants";
import FiltroAvancado from "../../components/UI/FilterAdvanced.vue";
import FormButton from "../../components/UI/FormButton.vue";
import TextField from "../../components/Inputs/TextField.vue";
import Select from "../../components/Inputs/Select.vue";

export default {
  name: "produtoModule",
  components: {
    DataTable,
    Breadcrumbs,
    FiltroAvancado,
    TextField,
    FormButton,
    Select,
  },
  data() {
    return {
      breadcrumbs: [...constants.breadcrumbsIndex],
      items: [],
      paginate: {
        ...constants.paginate,
      },
      headers: [...constants.headers],
      permissions: { ...constants.permissions },
      filter: {},
      drawer: null,
    };
  },
  async mounted() {
    await this.search();
    this.$root.$on("reloadDelete", () => this.search());
  },
  methods: {
    ...mapActions({
      produto: "$_produto/getItems",
    }),
    async search(search) {
      await this.produto({ search });
    },
    async handlePageChange(paginate) {
      await this.produto(paginate);
    },
  },
  beforeCreate() {
    const STORE_PRODUTO = "$_produto";
    if (!(STORE_PRODUTO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PRODUTO, store);
  },
  computed: {
    ...mapGetters({
      getItems: "$_produto/getItems",
    }),
  },
  watch: {
    getItems(value) {
      const resp = value;
      this.items = resp.data;
      this.paginate.totalPages = resp.total;
      this.paginate.page = resp.current_page;
      this.paginate.lastPage = resp.last_page;
    },
  },
};
</script>
<style lang="scss" scoped></style>
