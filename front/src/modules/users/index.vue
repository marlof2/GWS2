<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Perfil</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-form ref="form" v-model="valid" lazy-validation>
        <TextField
          v-model="form.name"
          :label="'Nome'"
          required
          :rules="required"
        />
        <TextField
          v-model="form.email"
          :label="'E-mail'"
          required
          :rules="required"
        />

        <v-card-actions>
          <v-spacer></v-spacer>
          <FormButton
            :isBack="true"
            :label="this.$strings.btn_voltar"
            dark
            @click="$router.go(-1)"
          />
          <FormButton
            :label="this.$strings.btn_salvar"
            dark
            @click="save"
          />
        </v-card-actions>
      </v-form>
    </v-card>
  </div>
</template>
<script>
import store from "./_store";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import TextField from "../../components/Inputs/TextField.vue";
import FormButton from "../../components/UI/FormButton.vue";
import { mapActions, mapGetters } from "vuex";
import { constants } from "./_constants";
import criptografia from "../../seguranca";

export default {
  name: "perfilModule",
  components: {
    Breadcrumbs,
    TextField,
    FormButton,
  },
  beforeCreate() {
    const STORE_USER = "$_user";
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, store);
  },
  data() {
    return {
      valid: true,
      formValidated: true,
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsIndex],
      items: [],
      required: [(v) => !!v || "Campo obrigatório"],
    };
  },
  async mounted() {
    await this.getUserByKey();
  },
  computed: {
    ...mapGetters({
      getUser: "$_user/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      user: "$_user/getItemById",
      update: "$_user/updateItem",
    }),

    async getUserByKey() {
      const key = criptografia.descryptografar(
        localStorage.getItem("user_key")
      );
      await this.user(key);
    },

    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      const resp = await this.update(this.form);

      if (resp.status == 200) {
        Swal.messageToast(resp.data, "success");
        this.$router.replace("pagina-inicial");
      }
    },
  },
  watch: {
    getUser(user) {
      let keys = Object.keys(this.form);
      keys.forEach((i) => {
        this.form[i] = user[i];
      });
    },
  },
};
</script>
