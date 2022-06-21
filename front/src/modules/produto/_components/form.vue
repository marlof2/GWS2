<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{
              $route.params.id != undefined ? "Edição de Produto" : "Novo Produto"
          }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="3" sm="3" md="3">
            <TextField v-model="form.nome" label="Nome" :maxlength="30" v-mask="''" :rules="required" required />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="3" sm="3" md="3">
            <TextField v-model="form.quantidade" label="Quantidade" :maxlength="30" v-mask="''" :rules="required"
              required />
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <v-card-actions style="margin-left: -7px;">
              <FormButton :isBack="true" :label="this.$strings.btn_voltar" dark
                @click="$router.go(-1)" />
              <FormButton :label="this.$strings.btn_salvar" dark
                @click="save" />
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
  name: "produtoForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
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
          this.$router.push({ name: "produto" });
          Swal.messageToast(this.$strings.msg_alterar, "success");
        }
      } else {
        const resp = await this.createItem(this.form);
        console.log(resp);
        if (resp.status == 201) {
          this.$router.push({ name: "produto" });
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
  },
};
</script>

<style lang="scss" scoped>
</style>
