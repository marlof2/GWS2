<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{
            $route.params.id != undefined
              ? "Editar Programação"
              : "Criar Programação"
          }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-stepper v-model="e1">
        <v-stepper-header>
          <v-stepper-step :complete="e1 > 1" step="1"
            >Dados do Clientes</v-stepper-step
          >

          <v-divider></v-divider>

          <v-stepper-step :complete="e1 > 2" step="2"
            >Dados da Programação</v-stepper-step
          >

          <v-divider></v-divider>

          <v-stepper-step step="3">Ítems da Programação</v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card class="pa-2">
              <v-form ref="form1" v-model="validStep1" lazy-validation>
                <v-row>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.nome"
                      label="Nome"
                      :maxlength="30"
                      v-mask="''"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.cpf_cnpj"
                      label="CPF/CNPJ"
                      v-mask="cnpjOrCpf"
                      :rules="required"
                      required
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="2" sm="2" md="2" xs="12">
                    <TextField
                      v-model="formStep1.cep"
                      label="CEP"
                      :maxlength="10"
                      v-mask="'##.###-###'"
                    />
                  </v-col>
                  <v-col cols="5" sm="5" md="5" xs="12">
                    <TextField
                      v-model="formStep1.endereco"
                      label="Endereço"
                      :maxlength="60"
                      v-mask="''"
                    />
                  </v-col>
                  <v-col cols="5" sm="5" md="5" xs="12">
                    <TextField
                      v-model="formStep1.complemento"
                      label="Complemento"
                      :maxlength="60"
                      v-mask="''"
                      :rules="required"
                      required
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.cidade"
                      label="Cidade"
                      :maxlength="30"
                      v-mask="''"
                    />
                  </v-col>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.bairro"
                      label="Bairro"
                      :maxlength="30"
                      v-mask="''"
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.telefone"
                      label="Telefone"
                      :maxlength="30"
                      v-mask="'(##) #####-####'"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.email"
                      label="E-mail"
                      :maxlength="30"
                      v-mask="''"
                    />
                  </v-col>
                </v-row>

                <v-row>
                  <v-col>
                    <v-card-actions>
                      <FormButton
                        :isBack="true"
                        :label="'Voltar'"
                        dark
                        @click="()=>{this.$router.push({ name: 'programacao' })}"
                        small
                      />
                      <FormButton
                        :label="'Salvar'"
                        dark
                        @click="saveCliente()"
                        small
                      />
                      <FormButton
                        :label="'Avançar'"
                        dark
                        @click="e1 = 2"
                        small
                      />
                    </v-card-actions>
                  </v-col>
                </v-row>
              </v-form>
            </v-card>
          </v-stepper-content>

          <v-stepper-content step="2">
            <v-card class="pa-2">
              <v-form ref="form2" v-model="validStep2" lazy-validation>
                <v-row>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <SelectAutocomplete
                      :items="getCliente.data"
                      :itemValue="'id'"
                      :itemText="'nome'"
                      :label="'Cliente'"
                      :rules="required"
                      required
                      v-model="formStep2.client_id"
                    />
                  </v-col>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <SelectAutocomplete
                      :items="getCondominio.data"
                      :itemValue="'id'"
                      :itemText="'nome'"
                      v-model="formStep2.condominium_id"
                      label="Condomínio"
                      :rules="required"
                      required
                    />
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <SelectAutocomplete
                      :items="getFormaPagamento.data"
                      :itemValue="'id'"
                      :itemText="'nome'"
                      v-model="formStep2.forma_pagamento_id"
                      label="Forma de Pagamento"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <SelectAutocomplete
                      :items="getUsuario.data"
                      :itemValue="'id'"
                      :itemText="'name'"
                      v-model="formStep2.user_id"
                      label="Funcionário"
                      :rules="required"
                      required
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="12" md="12" xs="12">
                    <TextArea
                      v-model="formStep2.observacao"
                      label="Observação"
                      :maxlength="200"
                      v-mask="''"
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep2.valor"
                      label="Valor"
                      :maxlength="30"
                      v-mask="''"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep2.garantia"
                      label="Garantia"
                      :maxlength="30"
                      v-mask="''"
                      :rules="required"
                      required
                    />
                  </v-col>
                </v-row>

                <v-row>
                  <v-col>
                    <v-card-actions>
                      <FormButton
                        :isBack="true"
                        :label="'Voltar'"
                        dark
                        @click="e1 = 1"
                        small
                      />
                      <FormButton
                        :label="'Salvar'"
                        dark
                        @click="saveProgramacao()"
                        small
                      />
                      <FormButton
                        :label="'Avançar'"
                        dark
                        @click="e1 = 3"
                        small
                      />
                    </v-card-actions>
                  </v-col>
                </v-row>
              </v-form>
            </v-card>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card class="pa-2">
              <v-col cols="12" sm="12" md="12">
                <DataTableInsider
                  :headers="tblProducts.headers"
                  :items="tblProducts.allProducts"
                  @onClickEdit="editProducts"
                  @onClickDelete="deleteProductsDialog"
                >
                  <template v-slot:top>
                    <HeaderDataTableInsider
                      :title="'Ítems'"
                      :addButtonClick="() => (tblProducts.dialog = true)"
                    />
                    <Dialog
                      v-model="tblProducts.dialog"
                      :maxWidth="600"
                      :title="'Ítems'"
                      :saveClick="saveProducts"
                      :closeClick="closeProducts"
                    >
                      <v-form
                        ref="form3"
                        v-model="validProducts"
                        lazy-validation
                      >
                        <v-row>
                          <v-col cols="6" sm="6" md="6">
                            <Select
                              v-model="tblProducts.product_id"
                              :itemValue="'id'"
                              :itemText="'descricao'"
                              :items="getProduto.data"
                              :label="'Produto'"
                              :rules="required"
                              required
                            />
                          </v-col>
                        </v-row>

                        <v-row>
                          <v-col cols="3" sm="3" md="3">
                            <TextField
                              v-model="tblProducts.quantidade"
                              label="Quantidade"
                              :maxlength="30"
                              v-mask="''"
                              :rules="required"
                              required
                            />
                          </v-col>
                        </v-row>
                      </v-form>
                    </Dialog>
                  </template>
                </DataTableInsider>
                <Dialog
                  v-model="tblProducts.dialogDelete"
                  :maxWidth="600"
                  :title="'Ítems'"
                  :closeClick="closeDeleteProducts"
                  :deleteClick="deleteProductsConfirm"
                  :isDelete="true"
                >
                  <h3>Tem certeza que deseja excluir este PF Documento?</h3>
                </Dialog>
              </v-col>

              <v-row>
                <v-col>
                  <v-card-actions>
                    <FormButton
                      :isBack="true"
                      :label="'Voltar'"
                      dark
                      @click="e1 = 2"
                      small
                    />
                    <FormButton
                      :label="'Finalizar'"
                      dark
                      @click="() => {}"
                      small
                    />
                  </v-card-actions>
                </v-col>
              </v-row>
            </v-card>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-card>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

import store from "../_store";
import storeCondominio from "../../condominio/_store";
import storeCliente from "../../cliente/_store";
import storeUser from "../../users/_store";
import storeFormaPagamento from "../../formaPagamento/_store";
import storeProduto from "../../produto/_store";

import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../_constants";

import TextField from "../../../components/Inputs/TextField.vue";
import SelectAutocomplete from "../../../components/Inputs/SelectAutocomplete.vue";
import TextArea from "../../../components/Inputs/TextArea.vue";
import Dialog from "../../../components/UI/Dialog.vue";
import DataTableInsider from "../../../components/UI/DataTableInsider.vue";
import HeaderDataTableInsider from "../../../components/UI/HeaderDataTableInsider.vue";

export default {
  name: "produtoForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
    SelectAutocomplete,
    TextArea,
    Dialog,
    DataTableInsider,
    HeaderDataTableInsider,
  },
  beforeCreate() {
    const STORE_PROGRAMACAO = "$_programacao";
    if (!(STORE_PROGRAMACAO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PROGRAMACAO, store);

    const STORE_CONDOMINIO = "$_condominio";
    if (!(STORE_CONDOMINIO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_CONDOMINIO, storeCondominio);

    const STORE_CLIENTE = "$_cliente";
    if (!(STORE_CLIENTE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_CLIENTE, storeCliente);

    const STORE_USER = "$_user";
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, storeUser);

    const STORE_FORMA_PAGAMENTO = "$_formaPagamento";
    if (!(STORE_FORMA_PAGAMENTO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_FORMA_PAGAMENTO, storeFormaPagamento);

    const STORE_PRODUTO = "$_produto";
    if (!(STORE_PRODUTO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PRODUTO, storeProduto);
  },
  data() {
    return {
      validStep1: true,
      validStep2: true,
      validProducts: true,
      formValidated: true,
      required: [(v) => !!v || "Campo obrigatório"],
      formStep1: { ...constants.formStep1 },
      formStep2: { ...constants.formStep2 },
      // formStep3: { ...constants.formStep3 },
      tblProducts: { ...constants.tblProducts },
      breadcrumbs: [...constants.breadcrumbsForm],

      e1: 1,
      cnpjOrCpf: "",
    };
  },
  async mounted() {
    this.breadcrumbs[1].text = "Cadastrar";
    if (this.$route.params.id != undefined) {
      this.breadcrumbs[1].text = "Editar";
      await this.itemById(this.$route.params.id);
    }
    console.log(this.formStep1);
    await this.actionCliente();
    await this.actionProduto();
    await this.actionCondominio();
    await this.actionUsuario();
    await this.actionFormaPagamento();
  },
  computed: {
    ...mapGetters({
      //programacao
      getProgramacao: "$_programacao/getItems",
      //cliente
      getCliente: "$_cliente/getItems",
      getClienteById: "$_cliente/getItemById",
      //produto
      getProduto: "$_produto/getItems",
      //condominio
      getCondominio: "$_condominio/getItems",
      //usuario
      getUsuario: "$_user/getItems",
      //forma de pagamento
      getFormaPagamento: "$_formaPagamento/getItems",
    }),
  },
  methods: {
    ...mapActions({
      //programacao
      actionProgramacao: "$_programacao/getItems",
      actionCreateProgramacao: "$_programacao/createItem",
      actionUpdateProgramacao: "$_programacao/updateItem",
      //cliente
      actionCliente: "$_cliente/getItems",
      actionCreateCliente: "$_cliente/createItem",
      actionUpdateCliente: "$_cliente/updateItem",
      actionClienteById: "$_cliente/getItemById",
      //produto
      actionProduto: "$_produto/getItems",
      //condominio
      actionCondominio: "$_condominio/getItems",
      //usuario
      actionUsuario: "$_user/getItems",
      //forma de pagamento
      actionFormaPagamento: "$_formaPagamento/getItems",
    }),
    async saveCliente() {
      this.formValidated = await this.$refs.form1.validate();
      if (!this.formValidated) {
        return false;
      }
      if (this.$route.params.id != undefined) {
        this.formStep1.id = this.$route.params.id;
        const resp = await this.actionUpdateCliente(this.formStep1);
        if (resp.status == 200) {
          Swal.messageToast(this.$strings.msg_alterar, "success");
          await this.actionCliente();
        }
      } else {
        const resp = await this.actionCreateCliente(this.formStep1);
        if (resp.status == 201) {
          Swal.messageToast(this.$strings.msg_adicionar, "success");
          await this.actionCliente();
        }
      }
    },
    async saveProgramacao() {
      this.formValidated = await this.$refs.form2.validate();
      if (!this.formValidated) {
        return false;
      }
      if (this.$route.params.id != undefined) {
        this.form.id = this.$route.params.id;
        const resp = await this.actionUpdateProgramacao(this.formStep2);
        if (resp.status == 200) {
          Swal.messageToast(this.$strings.msg_alterar, "success");
        }
      } else {
        const resp = await this.actionCreateProgramacao(this.formStep2);
        if (resp.status == 201) {
          Swal.messageToast(this.$strings.msg_adicionar, "success");
        }
      }
    },

    async saveProducts() {
      this.formProductsValidated = await this.$refs.formProducts.validate();
      if (!this.formProductsValidated) {
        return false;
      }

      if (this.tblProducts.editedIndex > -1) {
        const { status } = await this.updateProducts(this.tblProducts);
        if (status == 200)
          Swal.messageToast(this.$strings.msg_alterar, "success");
      } else {
        this.tblProducts.pessoa_fisica_id = this.$route.params.id;
        const { status } = await this.createProducts(this.tblProducts);
        if (status == 201)
          Swal.messageToast(this.$strings.msg_adicionar, "success");
      }
      await this.itemById(this.$route.params.id);
      this.resetProducts();
      this.closeProducts();
      this.tblProducts.editedIndex = -1;
    },

    async editProducts(item) {
      await this.ProductsById(item.id);

      this.tblProducts.editedIndex =
        this.form.pessoa_fisica_documento.indexOf(item);
      this.tblProducts.dialog = true;
    },

    async deleteProductsConfirm() {
      const { id } =
        this.form.pessoa_fisica_documento[this.tblProducts.editedIndex];
      const { status } = await this.deleteProducts(id);
      if (status == 200) {
        Swal.messageToast(this.$strings.item_excluido, "success");
        await this.itemById(this.$route.params.id);
      }
      this.tblProducts.dialogDelete = false;
    },

    deleteProductsDialog(item) {
      this.tblProducts.editedIndex =
        this.form.pessoa_fisica_documento.indexOf(item);
      this.tblProducts.dialogDelete = true;
    },

    resetProducts() {
      this.tblProducts = { ...constants.tblProducts };
    },

    closeProducts() {
      this.tblProducts.dialog = false;
      this.tblProducts = { ...constants.tblProducts };
      this.$refs.formProducts.reset();
    },

    closeDeleteProducts() {
      this.tblProducts.dialogDelete = false;
      this.tblProducts = { ...constants.tblProducts };
      this.$refs.formProducts.reset();
    },
  },
  watch: {
    getItemById(item) {
      if (this.$route.params.id != undefined) {
        let keys = Object.keys(this.form);
        keys.forEach((i) => {
          this.form[i] = item[i];
        });
      }
    },
    getClienteById(item) {
      console.log(item);
      if (this.$route.params.id != undefined) {
        let keys = Object.keys(this.formStep1);
        keys.forEach((i) => {
          this.form[i] = item[i];
        });
      }
    },
    getProductsById(Products) {
      const {
        id,
        pessoa_fisica_id,
        tipo_documento_id,
        inscricao,
        complemento,
      } = Products;
      this.tblProducts.id = id;
      this.tblProducts.pessoa_fisica_id = pessoa_fisica_id;
      this.tblProducts.tipo_documento_id = tipo_documento_id;
      this.tblProducts.inscricao = inscricao;
      this.tblProducts.complemento = complemento;
    },

    "formStep1.cpf_cnpj": function () {
      if (this.formStep1.cpf_cnpj.length < 15) {
        this.cnpjOrCpf = "###.###.###-##";
      } else {
        this.cnpjOrCpf = "##.###.###/####-##";
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
