<template>
  <v-menu offset-y left transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-icon class="mr-3" size="34" v-on="on" color="black">mdi-account-circle</v-icon>
    </template>

    <!-- user menu list -->
    <v-list dense nav>
      <v-list-item v-for="(item, index) in menu" :key="index" :to="item.link" :exact="item.exact"
        :disabled="item.disabled" link>
        <v-list-item-icon>
          <v-icon small :class="{ 'grey--text': item.disabled }">{{
              item.icon
          }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{
              item.key ? $t(item.key) : item.text
          }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider class="my-1"></v-divider>

      <v-list-item @click="logout()">
        <v-list-item-icon>
          <v-icon small>mdi-logout-variant</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Sair</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import config from "../../configs";
import store from "../../modules/login/_store";
import { mapActions } from "vuex";
/*
|---------------------------------------------------------------------
| Toolbar User Component
|---------------------------------------------------------------------
|
| Quickmenu for user menu shortcuts on the toolbar
|
*/
export default {
  data() {
    return {
      menu: config.toolbar.user,
    };
  },
 async mounted(){
  },
  methods: {
    ...mapActions({
    logout: "$_login/logout",
  }),
  },
  beforeCreate() {
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, store);
  },
};
</script>
