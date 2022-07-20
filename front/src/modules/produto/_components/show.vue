<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Visualização Produto</div>
         <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-row>
        <v-col cols="4" sm="4" md="4" xs="12">
          <ShowData :label="'Nome'" :data="form.nome" />
        </v-col>
        <v-col cols="4" sm="4" md="4" xs="12">
          <ShowData :label="'Quantidade'" :data="form.quantidade" />
        </v-col>
      </v-row>
      <v-row class="mt-5">
        <v-col cols="12" sm="12" md="12" xs="12">
          <v-card-actions>
            <v-col cols="12" sm="12" md="12" xs="12">
              <FormButton
                small
                :isBack="true"
                :label="this.$strings.btn_voltar"
                dark
                @click="$router.go(-1)"
              />
            </v-col>
          </v-card-actions>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import Vcol from "../../../components/UI/Vcol.vue";
import ShowData from "../../../components/UI/ShowData.vue";
import { constants } from "../_constants";

export default {
  name: "ProdutosShow",
  beforeCreate() {
    const STORE_PRODUTO = "$_produto";
    if (!(STORE_PRODUTO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PRODUTO, store);
  },
  data() {
    return {
      formValidated: true,
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsShow],
    };
  },
  async mounted() {
    if (this.$route.params.id != undefined) {
      await this.itemById(this.$route.params.id);
    }
  },
  components: {
    FormButton,
    Breadcrumbs,
    Vcol,
    ShowData,
  },
  computed: {
    ...mapGetters({
      getItemById: "$_produto/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_produto/getItemById",
    }),
  },
  watch: {
    getItemById(item) {
      console.log("first");
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

<style lang="scss" scoped></style>
