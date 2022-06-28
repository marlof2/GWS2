<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Visualização Condomínio</div>
        <Breadcrumbs :items="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-row>
        <ShowData :cols="6" :label="'Nome'" :data="form.nome" />
        <ShowData :cols="6" :label="'Valor à vista'" :data="form.valor_avista" />
        <ShowData :cols="6" :label="'Valor em cartão'" :data="form.valor_cartao" />
      </v-row>
      <v-card-actions>
        <v-spacer></v-spacer>
        <FormButton
          :isBack="true"
          :label="this.$strings.btn_voltar"
          dark
          @click="$router.go(-1)"
        />
      </v-card-actions>
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
  name: "condominioShow",
  beforeCreate() {
    const STORE_CONDOMINIO = "$_condominio";
    if (!(STORE_CONDOMINIO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_CONDOMINIO, store);
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
      getItemById: "$_condominio/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_condominio/getItemById",
    }),
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

<style lang="scss" scoped></style>
