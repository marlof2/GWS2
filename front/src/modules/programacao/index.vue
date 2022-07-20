<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Programação</div>
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
        :customItemsProp="customItemsProp"
      >
      </DataTable>
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
  name: "programacaoModule",
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
      customItemsProp: { ...constants.customItemsProp },
      filter: {},
      drawer: null,
    };
  },
  async mounted() {
    await this.search();
  },
  methods: {
    ...mapActions({
      programacao: "$_programacao/getItems",
      actionAtender: "$_programacao/atender",
      actionNaoAtender: "$_programacao/naoAtender",
      actionFlagAtender: "$_programacao/flagAtender",
      actionFlagNaoAtender: "$_programacao/flagNaoAtender",
      actionFlagComprovante: "$_programacao/flagComprovante",
      actionFlagImprimir: "$_programacao/flagImprimir",
      reloadIndex: "$_deleteGlobal/reloadIndex",
    }),
    async search(search) {
      await this.programacao({ search });
    },
    async handlePageChange(paginate) {
      await this.programacao(paginate);
    },
  },
  beforeCreate() {
    const STORE_PROGRAMACAO = "$_programacao";
    if (!(STORE_PROGRAMACAO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PROGRAMACAO, store);
    const STORE_DELETE = "$_deleteGlobal";
    if (!(STORE_DELETE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_DELETE, storeDelete);
  },
  computed: {
    ...mapGetters({
      getItems: "$_programacao/getItems",
      getAtender: "$_programacao/flagAtender",
      getNaoAtender: "$_programacao/flagNaoAtender",
      getReloadIndex: "$_deleteGlobal/reloadIndex",
      getComprovante: "$_programacao/flagComprovante",
      getImprirmir: "$_programacao/flagImprimir",
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
    async getAtender(object) {
      if (object.flag) {
        const result = await this.actionAtender(object.id);
        if (result.status === 200) {
          Swal.message("Atentido!");
          await this.search();
        }
      }
      await this.actionFlagAtender({ flag: false });
    },
    async getNaoAtender(object) {
      if (object.flag) {
        const result = await this.actionNaoAtender(object.id);
        if (result.status === 200) {
          Swal.message("Não Atentido!");
          await this.search();
        }
      }
      await this.actionFlagNaoAtender({ flag: false });
    },
    async getComprovante(object) {
      if (object.flag) {
        // console.log(object);
        // Swal.message("Em andamento!");
      }
      await this.actionFlagComprovante({ flag: false });
    },
    async getImprirmir(object) {
      if (object.flag) {
        // Swal.message("Em andamento!");
      }
      await this.actionFlagImprimir({ flag: false });
    },
  },
};
</script>
<style lang="scss" scoped>
</style>
