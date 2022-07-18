<template>
  <div class="d-flex flex-grow-1 flex-column">
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
        :permissions="permissions"
      />
    </v-card>
  </div>
</template>
<script>
import store from "./_store";
import storeDelete from "../deleteGlobal/_store";
import DataTable from "../../components/UI/DataTable.vue";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import { mapActions, mapGetters } from "vuex";
import { constants } from "./_constants";
import FormButton from "../../components/UI/FormButton.vue";
import TextField from "../../components/Inputs/TextField.vue";
import Select from "../../components/Inputs/Select.vue";

export default {
  name: "produtoModule",
  components: {
    DataTable,
    Breadcrumbs,
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
  },
  methods: {
    ...mapActions({
      produto: "$_produto/getItems",
      reloadIndex: "$_deleteGlobal/reloadIndex",
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
    const STORE_DELETE = "$_deleteGlobal";
    if (!(STORE_DELETE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_DELETE, storeDelete);
  },
  computed: {
    ...mapGetters({
      getItems: "$_produto/getItems",
      getReloadIndex: "$_deleteGlobal/reloadIndex",
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
    async getReloadIndex(value) {
      if (value) {
        await this.search();
      }
      await this.reloadIndex(false);
    },
  },
};
</script>
<style lang="scss" scoped></style>
