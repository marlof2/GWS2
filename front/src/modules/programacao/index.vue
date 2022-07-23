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
    <Dialog
      v-model="tblUpload.dialog"
      :maxWidth="900"
      :title="'Anexar Comprovantes'"
      :saveClick="saveReceipt"
      :closeClick="closeDialog"
    >
      <v-form
        ref="form"
        v-model="validForm"
        lazy-validation
        enctype="multipart/form-data"
      >
        <v-row>
          <v-col cols="12" sm="12" md="12" xs="12">
            <v-file-input
              accept="image/*"
              v-model="formUpload"
              counter
              show-size
              label="Upload de Arquivos"
              required
              :rules="required"
            ></v-file-input>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="12" md="12" xs="12">
            <DataTableInsider
              :headers="tblUpload.headers"
              :items="itemsUpload"
              @onClickEdit="editUpload"
              @onClickDelete="deleteUploadDialog"
            >
              <template v-slot:top>
                <HeaderDataTableInsider
                  :title="'Comprovantes'"
                  :hideBtnAdd="false"
                />
              </template>
            </DataTableInsider>
          </v-col>
        </v-row>
      </v-form>
    </Dialog>
  </div>
</template>
<script>
import store from "./_store";
import storeDelete from "../deleteGlobal/_store";
import storeProgramacaoDocumento from "../programacaoDocumento/_store";
import storeDocumento from "../documento/_store";
import DataTable from "../../components/UI/DataTable.vue";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import { mapActions, mapGetters } from "vuex";
import { constants } from "./_constants";
import FormButton from "../../components/UI/FormButton.vue";
import TextField from "../../components/Inputs/TextField.vue";
import Select from "../../components/Inputs/Select.vue";
import Dialog from "../../components/UI/Dialog.vue";
import DataTableInsider from "../../components/UI/DataTableInsider.vue";
import HeaderDataTableInsider from "../../components/UI/HeaderDataTableInsider.vue";

export default {
  name: "programacaoModule",
  components: {
    DataTable,
    Breadcrumbs,
    TextField,
    FormButton,
    Select,
    Dialog,
    DataTableInsider,
    HeaderDataTableInsider,
  },
  data() {
    return {
      required: [(v) => !!v || "Campo obrigatório"],
      validForm: true,
      formValidated: true,
      breadcrumbs: [...constants.breadcrumbsIndex],
      items: [],
      paginate: {
        ...constants.paginate,
      },
      headers: [...constants.headers],
      permissions: { ...constants.permissions },
      customItemsProp: { ...constants.customItemsProp },
      tblUpload: { ...constants.tblUpload },
      filter: {},
      drawer: null,
      formUpload: null,
      itemsUpload: [],
    };
  },
  async mounted() {
    await this.search();
    // this.tblUpload.dialog = true;
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
      actionProgramacaoDocumento: "$_programacaoDocumento/createItem",
      actionDocumento: "$_documento/createItem",
    }),
    async search(search) {
      await this.programacao({ search });
    },
    loadDocumentos(items, programation_id) {
      const documentos = items.find((docs) => docs.id == programation_id);
      this.itemsUpload = documentos.documento;
    },
    async handlePageChange(paginate) {
      await this.programacao(paginate);
    },
    async closeDialog() {
      this.tblUpload.dialog = false;
    },
    async saveReceipt() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      const payload = new FormData();

      payload.append("file", this.formUpload, this.formUpload.name);
      payload.append("name", this.formUpload.name);
      payload.append("type", this.formUpload.type);
      payload.append("programation_id", this.tblUpload.programation_id);

      const result = await this.actionDocumento(payload);
      if (result.status === 201) {
        await this.search();
        this.formUpload = null;
        Swal.messageToast(this.$strings.msg_adicionar, "success");
      }
    },
    async editUpload(item) {
      this.tblUpload.isEdit = true;
      // this.formStep3.product_id = item.pivot.product_id;
      // this.formStep3.quantidade = item.quantidade;

      this.tblUpload.dialog = true;
    },
    deleteUploadDialog(item) {
      // this.formStep3.product_id = item.pivot.product_id;
      // this.formStep3.quantidade = item.quantidade;

      this.tblUpload.dialogDelete = true;
    },
  },
  beforeCreate() {
    const STORE_PROGRAMACAO = "$_programacao";
    if (!(STORE_PROGRAMACAO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PROGRAMACAO, store);
    const STORE_DELETE = "$_deleteGlobal";
    if (!(STORE_DELETE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_DELETE, storeDelete);
    const STORE_PROGRAMACAO_DOCUMENTO = "$_programacaoDocumento";
    if (!(STORE_PROGRAMACAO_DOCUMENTO in this.$store._modules.root._children))
      this.$store.registerModule(
        STORE_PROGRAMACAO_DOCUMENTO,
        storeProgramacaoDocumento
      );
    const STORE_DOCUMENTO = "$_documento";
    if (!(STORE_DOCUMENTO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_DOCUMENTO, storeDocumento);
  },
  computed: {
    ...mapGetters({
      getItems: "$_programacao/getItems",
      getAtender: "$_programacao/flagAtender",
      getNaoAtender: "$_programacao/flagNaoAtender",
      getComprovante: "$_programacao/flagComprovante",
      getImprirmir: "$_programacao/flagImprimir",
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
      if (this.tblUpload.programation_id) {
        this.loadDocumentos(this.items, this.tblUpload.programation_id);
      }
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
      this.tblUpload.dialog = true;
      if (object.flag) {
        this.tblUpload.programation_id = object.id;
        this.loadDocumentos(this.items, this.tblUpload.programation_id);
        await this.actionFlagComprovante({ flag: false });
      }
    },
    async getImprirmir(object) {
      if (object.flag) {
      }
      await this.actionFlagImprimir({ flag: false });
    },
  },
};
</script>
<style lang="scss" scoped>
</style>
