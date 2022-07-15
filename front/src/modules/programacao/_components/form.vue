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
      <v-stepper v-model="transition">
        <v-stepper-header>
          <v-stepper-step :complete="transition > 1" step="1"
            >Dados do Clientes</v-stepper-step
          >

          <v-divider></v-divider>

          <v-stepper-step :complete="transition > 2" step="2"
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
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.cpf_cnpj"
                      label="CPF/CNPJ"
                      v-mask="dualMask"
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
                    />
                  </v-col>
                  <v-col cols="5" sm="5" md="5" xs="12">
                    <TextField
                      v-model="formStep1.complemento"
                      label="Complemento"
                      :maxlength="60"
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
                    />
                  </v-col>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <TextField
                      v-model="formStep1.bairro"
                      label="Bairro"
                      :maxlength="30"
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
                        @click="backToProgramation()"
                        small
                      />
                      <FormButton
                        :label="'Salvar'"
                        dark
                        @click="saveCliente()"
                        small
                      />
                      <FormButton
                        :isBack="true"
                        :label="'Avançar'"
                        dark
                        @click="transition = 2"
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
                  <v-col cols="12" sm="4" md="4" xs="12">
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
                  <v-col cols="12" sm="4" md="4" xs="12">
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
                  <v-col cols="12" sm="4" md="4" xs="12">
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
                </v-row>
                <v-row>
                  <v-col cols="12" sm="4" md="4" xs="12">
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
                  <v-col cols="12" sm="4" md="4" xs="12">
                    <DatePicker
                      :label="'Data'"
                      :date.sync="formStep2.data"
                      v-model="formStep2.data"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="12" sm="4" md="4" xs="12">
                    <TimePicker
                      :label="'Hora'"
                      :return-value.sync="formStep2.hora"
                      v-model="formStep2.hora"
                      :rules="required"
                      required
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="4" md="4" xs="12">
                    <TextField
                      v-model="formStep2.valor"
                      label="Valor"
                      :maxlength="30"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="12" sm="4" md="4" xs="12">
                    <TextField
                      v-model="formStep2.garantia"
                      label="Garantia"
                      :maxlength="30"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="12" sm="4" md="4" xs="12">
                    <TextField
                      v-model="formStep2.descricao"
                      label="Descricão"
                      :maxlength="150"
                    />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="12" md="12" xs="12">
                    <TextArea
                      v-model="formStep2.observacao"
                      label="Observação"
                      :maxlength="300"
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
                        @click="transition = 1"
                        small
                      />
                      <FormButton
                        :label="'Salvar'"
                        @click="saveProgramacao()"
                        small
                        :disabled="disabledBtnSalvarProgramacao()"
                      />
                      <FormButton
                        @click="transition = 3"
                        :isBack="true"
                        :label="'Avançar'"
                        small
                        :disabled="disabledBtnProximoProgramacao()"
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
                <v-row>
                  <v-col
                    v-if="formStep3.programation_id"
                    cols="12"
                    sm="4"
                    md="4"
                    xs="12"
                  >
                    <h4>
                      Código da Programação
                      {{ "#" + formStep3.programation_id }}
                    </h4>
                  </v-col>
                </v-row>
                <DataTableInsider
                  :headers="tblProducts.headers"
                  :items="itemDataTableInsider()"
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
                            <SelectAutocomplete
                              v-model="formStep3.product_id"
                              :itemValue="'id'"
                              :itemText="'nome'"
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
                              v-model="formStep3.quantidade"
                              label="Quantidade"
                              :maxlength="30"
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
                  :title="''"
                  :closeClick="closeDeleteProducts"
                  :deleteClick="deleteProductsConfirm"
                  :isDelete="true"
                >
                  <h3>Tem certeza que deseja excluir este produto?</h3>
                </Dialog>
              </v-col>

              <v-row>
                <v-col>
                  <v-card-actions>
                    <FormButton
                      :isBack="true"
                      :label="'Voltar'"
                      dark
                      @click="transition = 2"
                      small
                    />
                    <FormButton
                      :label="'Finalizar'"
                      dark
                      @click="backToProgramation()"
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
import storeProgramacaoProduto from "../../programacaoProduto/_store";
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
import DatePicker from "../../../components/Inputs/DatePicker.vue";
import TimePicker from "../../../components/Inputs/TimePicker.vue";

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
    DatePicker,
    TimePicker,
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

    const STORE_PROGRAMACAO_PRODUTO = "$_programacaoProduto";
    if (!(STORE_PROGRAMACAO_PRODUTO in this.$store._modules.root._children))
      this.$store.registerModule(
        STORE_PROGRAMACAO_PRODUTO,
        storeProgramacaoProduto
      );
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
      formStep3: { ...constants.formStep3 },
      tblProducts: { ...constants.tblProducts },
      breadcrumbs: [...constants.breadcrumbsForm],
      transition: 1,
      dualMask: "",
      verifyValueDisabled: false,
    };
  },
  async mounted() {
    this.breadcrumbs[1].text = "Cadastrar";
    if (this.$route.params.id != undefined) {
      this.breadcrumbs[1].text = "Editar";
      await this.actionProgramacaoById(this.$route.params.id);
    }
    await this.actionCliente({ limit: "-1" });
    await this.actionProduto({ limit: "-1" });
    await this.actionCondominio({ limit: "-1" });
    await this.actionUsuario({ limit: "-1" });
    await this.actionFormaPagamento();
  },
  computed: {
    ...mapGetters({
      //programacao
      getProgramacao: "$_programacao/getItems",
      getProgramacaoById: "$_programacao/getItemById",
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
      //programacaoProduto
      actionCreateProgramacaoProduto: "$_programacaoProduto/createItem",
      actionUpdateProgramacaoProduto: "$_programacaoProduto/updateItem",
      actionDeleteProgramacaoProduto: "$_programacaoProduto/deleteItem",
      //programacao
      actionProgramacao: "$_programacao/getItems",
      actionCreateProgramacao: "$_programacao/createItem",
      actionUpdateProgramacao: "$_programacao/updateItem",
      actionProgramacaoById: "$_programacao/getItemById",
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
    disabledBtnProximoProgramacao() {
      if (this.formStep3.programation_id == null) return true;
      else return false;
    },
    disabledBtnSalvarProgramacao() {
      if (
        this.$route.name == "programacao-cadastrar" &&
        this.verifyValueDisabled
      ) {
        return true;
      }
    },
    backToProgramation() {
      return this.$router.push({ name: "programacao" });
    },
    async saveCliente() {
      this.formValidated = await this.$refs.form1.validate();
      if (!this.formValidated) {
        return false;
      }
      if (this.formStep1.id) {
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
        this.formStep2.id = this.$route.params.id;

        const resp = await this.actionUpdateProgramacao(this.formStep2);
        if (resp.status == 200) {
          Swal.messageToast(this.$strings.msg_alterar, "success");
        }
      } else {
        const resp = await this.actionCreateProgramacao(this.formStep2);
        if (resp.status == 201) {
          Swal.messageToast(this.$strings.msg_adicionar, "success");
          this.formStep3.programation_id = resp.data.data.id;
          await this.actionProgramacaoById(this.formStep3.programation_id);
          this.verifyValueDisabled = true
        }
      }
    },

    async saveProducts() {
      this.formValidated = await this.$refs.form3.validate();
      if (!this.formValidated) {
        return false;
      }

      if (this.tblProducts.isEdit) {
        const { status } = await this.actionUpdateProgramacaoProduto(
          this.formStep3
        );
        if (status == 200) {
          Swal.messageToast(this.$strings.msg_alterar, "success");
          await this.actionProgramacaoById(this.formStep3.programation_id);
          this.tblProducts.isEdit = false;
        }
      } else {
        const { status } = await this.actionCreateProgramacaoProduto(
          this.formStep3
        );
        if (status == 201)
          Swal.messageToast(this.$strings.msg_adicionar, "success");
        await this.actionProgramacaoById(this.formStep3.programation_id);

        this.resetFormStep3();
        this.resetProducts();
      }

      this.resetProducts();
      this.closeProducts();
    },

    async editProducts(item) {
      this.tblProducts.isEdit = true;
      this.formStep3.product_id = item.pivot.product_id;
      this.formStep3.quantidade = item.quantidade;

      this.tblProducts.dialog = true;
    },

    async deleteProductsConfirm() {
      const { status } = await this.actionDeleteProgramacaoProduto(
        this.formStep3
      );
      if (status === 200) {
        Swal.messageToast(this.$strings.item_excluido, "success");
        await this.actionProgramacaoById(this.formStep3.programation_id);
      }
      this.tblProducts.dialogDelete = false;
      this.resetProducts();
      this.resetFormStep3();
    },

    deleteProductsDialog(item) {
      this.formStep3.product_id = item.pivot.product_id;
      this.formStep3.quantidade = item.quantidade;

      this.tblProducts.dialogDelete = true;
    },

    resetProducts() {
      this.tblProducts = { ...constants.tblProducts };
    },

    resetFormStep3() {
      this.formStep3.quantidade = null;
      this.formStep3.product_id = null;
    },

    closeProducts() {
      this.$refs.form3.reset();
      this.resetProducts();
      this.tblProducts.dialog = false;
    },

    closeDeleteProducts() {
      this.$refs.form3.reset();
      this.resetProducts();
      this.resetFormStep3();
      this.tblProducts.dialogDelete = false;
    },

    itemDataTableInsider() {
      return this.formStep3.programation_id && this.getProgramacaoById[0]
        ? this.getProgramacaoById[0].produtos
        : [];
    },
  },
  watch: {
    getProgramacaoById(item) {
      if (this.$route.params.id != undefined) {
        this.formStep1 = { ...item[0].cliente };
        this.formStep2 = { ...item[0] };
        this.formStep3.programation_id = item[0].id;
      }
    },
    // "formStep1.cpf_cnpj": {
    //   handler(newValue) {
    //     if (newValue.length <= 14) {
    //       this.dualMask = "###.###.###-##";
    //     }
    //     if (newValue.length >= 15) {
    //       this.dualMask = "##.###.###/####-##";
    //     }
    //     // console.log(this.dualMask);
    //   },
    //   deep: true,
    // },
  },
};
</script>

<style lang="scss" scoped>
</style>
