<template>
  <v-menu offset-y left transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-icon class="mr-3" size="34" v-on="on" color="black"
        >mdi-account-circle</v-icon
      >
    </template>

    <!-- user menu list -->
    <v-list dense nav>
      <v-list-item
        v-for="(item, index) in menu"
        :key="index"
        :to="item.link"
        :exact="item.exact"
        :disabled="item.disabled"
        link
      >
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

      <v-list-item @click="logout">
        <v-list-item-icon>
          <v-icon small>mdi-logout-variant</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{ $t("menu.logout") }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import config from "../../configs";
import jwt from "../../api/jwt";
import router from "../../router";
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
  methods: {
    logout() {
      // jwt.destroyToken();
      // window.localStorage.removeItem("permissions");
      // window.localStorage.removeItem("permissions_system");
      // window.localStorage.removeItem("permissions_modules");
      // window.localStorage.removeItem("current_system");
      // window.localStorage.removeItem("user_key");
      // window.localStorage.removeItem("expired_at");
      router.push({ name: "autenticar" });
    },
  },
};
</script>
