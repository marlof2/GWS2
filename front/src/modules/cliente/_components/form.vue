<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{
            $route.params.id != undefined ? "Edição de Cliente" : "Novo Cliente"
          }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="6" sm="6" md="6" xs="12">
            <TextField
              v-model="form.nome"
              label="Nome"
              :maxlength="30"
              :rules="required"
              required
            />
          </v-col>
          <v-col cols="12" sm="6" md="6" xs="12">
            <TextField
              v-model="form.cpf_cnpj"
              label="CPF/CNPJ"
              v-mask="dualMask"
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="2" sm="2" md="2" xs="12">
            <TextField
              v-model="form.cep"
              label="CEP"
              :maxlength="10"
              v-mask="'##.###-###'"
            />
          </v-col>
          <v-col cols="5" sm="5" md="5" xs="12">
            <TextField
              v-model="form.endereco"
              label="Endereço"
              :maxlength="60"
            />
          </v-col>
          <v-col cols="5" sm="5" md="5" xs="12">
            <TextField
              v-model="form.complemento"
              label="Complemento"
              :maxlength="60"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6" sm="6" md="6" xs="12">
            <TextField v-model="form.cidade" label="Cidade" :maxlength="30" />
          </v-col>
          <v-col cols="6" sm="6" md="6" xs="12">
            <TextField v-model="form.bairro" label="Bairro" :maxlength="30" />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6" sm="6" md="6" xs="12">
            <TextField
              v-model="form.telefone"
              label="Telefone"
              :maxlength="30"
              v-mask="'(##) #####-####'"
              :rules="required"
              required
            />
          </v-col>
          <v-col cols="6" sm="6" md="6" xs="12">
            <TextField v-model="form.email" label="E-mail" :maxlength="30" />
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <v-card-actions>
              <FormButton
                :isBack="true"
                :label="'Voltar'"
                dark
                @click="$router.go(-1)"
                small
              />
              <FormButton :label="'Salvar'" dark @click="save()" small />
            </v-card-actions>
          </v-col>
        </v-row>
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

export default {
  name: "clienteForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
  },
  beforeCreate() {
    const STORE_CLIENTE = "$_cliente";
    if (!(STORE_CLIENTE in this.$store._modules.root._children))
      this.$store.registerModule(STORE_CLIENTE, store);
  },
  data() {
    return {
      valid: true,
      formValidated: true,
      required: [(v) => !!v || "Campo obrigatório"],
      dualMask: "",
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsForm],
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
      getItemById: "$_cliente/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_cliente/getItemById",
      createItem: "$_cliente/createItem",
      updateItem: "$_cliente/updateItem",
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
          this.$router.push({ name: "cliente" });
          Swal.messageToast(this.$strings.msg_alterar, "success");
        }
      } else {
        const resp = await this.createItem(this.form);
        if (resp.status == 201) {
          this.$router.push({ name: "cliente" });
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

<style lang="scss" scoped></style>
