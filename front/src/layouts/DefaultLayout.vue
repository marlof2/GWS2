<template>
  <div>
    <!-- Navigation -->
    <v-navigation-drawer v-model="drawer" absolute app floating class="elevation-1" :right="$vuetify.rtl"
      :light="menuTheme === 'light'" :dark="menuTheme === 'dark'">
      <!-- Navigation menu info -->
      <template v-slot:prepend>
        <div class="pa-2">
          <div class="title font-weight-bold text-uppercase primary--text">
            <v-row>
              <v-img style="margin-left: 26px;" max-height="30" max-width="30" src="../../public/images/gws.png" />
              <v-col col="12">
                {{ product.name }}
              </v-col>
            </v-row>
          </div>
        </div>
      </template>

      <!-- Navigation menu -->
      <main-menu :menu="navigation.menu" />

    </v-navigation-drawer>

    <!-- Toolbar -->
    <v-app-bar app :color="isToolbarDetached ? 'surface' : undefined" :flat="isToolbarDetached"
      :light="toolbarTheme === 'light'" :dark="toolbarTheme === 'dark'">
      <v-card class="flex-grow-1 d-flex" :class="[isToolbarDetached ? 'pa-1 mt-3 mx-1' : 'pa-0 ma-0']"
        :flat="!isToolbarDetached">
        <div class="d-flex flex-grow-1 align-center">
          <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

          <v-spacer class="d-none d-lg-block"></v-spacer>

          <toolbar-user />
        </div>
      </v-card>
    </v-app-bar>

    <v-main>
      <v-container class="fill-height" :fluid="!isContentBoxed">
        <v-layout>
          <slot></slot>
        </v-layout>
      </v-container>
    </v-main>
  </div>
</template>

<script>
import { mapState } from "vuex";

// navigation menu configurations
import config from "../configs";

import MainMenu from "../components/navigation/MainMenu";
import ToolbarUser from "../components/toolbar/ToolbarUser";

export default {
  components: {
    MainMenu,
    ToolbarUser,
  },
  data() {
    return {
      drawer: null,
      showSearch: false,

      navigation: config.navigation,
    };
  },
  computed: {
    ...mapState("app", [
      "product",
      "isContentBoxed",
      "menuTheme",
      "toolbarTheme",
      "isToolbarDetached",
    ]),
  },
  methods: {
  },
};
</script>

<style scoped>
.buy-button {
  box-shadow: 1px 1px 18px #ee44aa;
}
</style>
