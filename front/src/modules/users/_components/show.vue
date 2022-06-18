<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Visualização País</div>
        <Breadcrumbs :items="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-form>
        <v-card-actions>
          <v-spacer></v-spacer>
          <FormButton
            :background="this.$colors.btn_voltar"
            :label="this.$strings.btn_voltar"
            dark
            @click="$router.go(-1)"
          />
        </v-card-actions>
      </v-form>
    </v-card>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import storePaises from "../_store";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../_constants";

export default {
  name: "<%=NMEntidadeCamelCase%>Show",
  beforeCreate() {
    const STORE_PAIS = "$_pais";
    if (!(STORE_PAIS in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PAIS, store);
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
  },
  computed: {
    ...mapGetters({
      getItemById: "$_pais/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_pais/getItemById",
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
