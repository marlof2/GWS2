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
      <v-form ref="form" v-model="valid" lazy-validation>
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
                      :maxlength="8"
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
                      v-mask="'(##) #########'"
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
                        :label="'Limpar Campos'"
                        dark
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
              </v-card>
            </v-stepper-content>

            <v-stepper-content step="2">
              <v-card class="pa-2">
                <v-row>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <SelectAutocomplete
                      v-model="formStep2.client_id"
                      label="Cliente"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="12" sm="6" md="6" xs="12">
                    <SelectAutocomplete
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
                      v-model="formStep2.forma_pagamento_id"
                      label="Forma de Pagamento"
                      :rules="required"
                      required
                    />
                  </v-col>
                  <v-col cols="6" sm="6" md="6" xs="12">
                    <SelectAutocomplete
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
                      :rules="required"
                      required
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
                        :label="'Avançar'"
                        dark
                        @click="e1 = 3"
                        small
                      />
                    </v-card-actions>
                  </v-col>
                </v-row>
              </v-card>
            </v-stepper-content>

            <v-stepper-content step="3">
              <v-card class="pa-2">
                

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
                      <FormButton :label="'Avançar'" dark @click="save" small />
                    </v-card-actions>
                  </v-col>
                </v-row>
              </v-card>
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>
      </v-form>
    </v-card>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../_constants";

import TextField from "../../../components/Inputs/TextField.vue";
import SelectAutocomplete from "../../../components/Inputs/SelectAutocomplete.vue";
import TextArea from "../../../components/Inputs/TextArea.vue";

export default {
  name: "produtoForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
    SelectAutocomplete,
    TextArea,
  },
  beforeCreate() {
    const STORE_PRODUTO = "$_produto";
    if (!(STORE_PRODUTO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PRODUTO, store);
  },
  data() {
    return {
      valid: true,
      formValidated: true,
      required: [(v) => !!v || "Campo obrigatório"],

      rulesNumber: [(v) => v.length <= 10 || "Max 10 números"],
      rulesTextArea: [(v) => v.length <= 100 || "Max 100 caratéres"],
      rulesCodigo: [(v) => v.length <= 5 || "Max 5 números"],
      formStep1: { ...constants.formStep1 },
      formStep2: { ...constants.formStep2 },
      formStep3: { ...constants.formStep3 },
      breadcrumbs: [...constants.breadcrumbsForm],
      e1: 1,
      cnpjOrCpf: null,
    };
  },
  async mounted() {
    this.breadcrumbs[1].text = "Cadastrar";
    if (this.$route.params.id != undefined) {
      this.breadcrumbs[1].text = "Editar";
      await this.itemById(this.$route.params.id);
    }
  },
  computed: {
    ...mapGetters({
      getItemById: "$_produto/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_produto/getItemById",
      createItem: "$_produto/createItem",
      updateItem: "$_produto/updateItem",
    }),
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      if (this.$route.params.id != undefined) {
        this.form.id = this.$route.params.id;
        const resp = await this.updateItem(this.form);
        if (resp.status == 200) {
          this.$router.push({ name: "produtos" });
          Swal.messageToast(this.$strings.msg_alterar, "success");
        }
      } else {
        const resp = await this.createItem(this.form);
        console.log(resp);
        if (resp.status == 201) {
          this.$router.push({ name: "produtos" });
          Swal.messageToast(this.$strings.msg_adicionar, "success");
        }
      }
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
