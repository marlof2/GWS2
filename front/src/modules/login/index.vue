<template>
  <div>
    <v-card class="text-center pa-1">
      <img class="image-logo" src="../../assets/images/logo.png" />
      <v-card-title class="justify-center display-1">Bem-vindo(a)</v-card-title>
      <v-card-subtitle>Entre em sua conta</v-card-subtitle>

      <!-- sign in form -->
      <v-card-text>
        <v-form ref="form" v-model="isFormValid" lazy-validation>
          <v-text-field
            v-model="form.email"
            :rules="[rules.required]"
            :validate-on-blur="false"
            :error="error"
            :label="$t('login.email')"
            name="email"
            @keyup.enter="submit"
            @change="resetErrors"
          ></v-text-field>

          <v-text-field
            v-model="form.password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required]"
            :type="showPassword ? 'text' : 'password'"
            :error="error"
            :error-messages="errorMessages"
            :label="$t('login.password')"
            name="password"
            @keyup.enter="submit"
            @click:append="showPassword = !showPassword"
          ></v-text-field>

          <v-btn
            :disabled="isSignInDisabled"
            block
            x-large
            :color="'#00A370'"
            dark
            @click="submit"
            >{{ $t("login.button") }}</v-btn
          >

          <div class="mt-5">
            <router-link to="/auth/forgot-password">
              {{ $t("login.forgot") }}
            </router-link>
          </div>
        </v-form>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import store from "./_store";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      // sign in buttons
      isSignInDisabled: false,

      // form
      isFormValid: true,
      form: {
        email: "marlosilva.f2@gmail.com",
        password: "12345678",
      },

      // form error
      error: false,
      errorMessages: "",

      // show password field
      showPassword: false,

      // input rules
      rules: {
        required: (value) => (value && Boolean(value)) || "Campo obrigatório",
      },
    };
  },
  async mounted() {},
  methods: {
    ...mapActions({
      login: "$_login/authenticate",
      gerenciarAcesso: "$_login/usuarioPermissoes",
    }),
    async submit() {
      if (this.$refs.form.validate()) {
        this.isSignInDisabled = true;
        // await this.login(this.form);
        const result = this.authenticate;
        if (true) {
          // const current_system = result.systems.filter((sys) => sys.id == 3);

          // await this.gerenciarAcesso({ sistema_id: current_system[0].id });

          // const permissions = this.permissions;
          // const permissionsSystems = permissions.systems.map(
          //   (sys) => sys.codigo
          // );
          // const permissionsModules = permissions.modules.map(
          //   (module) => module.codigo
          // );

          // window.localStorage.setItem("current_system", current_system[0].id);
          // window.localStorage.setItem("permissions", permissions.permissions);
          // window.localStorage.setItem("permissions_system", permissionsSystems);
          // window.localStorage.setItem(
          //   "permissions_modules",
          //   permissionsModules
          // );

          // window.localStorage.setItem("user_key", result.user_key);
          // window.localStorage.setItem("expired_at", result.expired_at);

          this.$router.push("pagina-inicial");
        } else {
          this.isSignInDisabled = false;
        }
      }
    },
    resetErrors() {
      this.error = false;
      this.errorMessages = "";
    },
  },
  computed: {
    ...mapGetters({
      authenticate: "$_login/authenticated",
      permissions: "$_login/getUsuarioPermissoes",
    }),
  },
  beforeCreate() {
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, store);
  },
};
</script>
<style scoped>
.image-logo {
  margin-top: 20px;
  width: 150px;
  object-fit: contain;
}
</style>
