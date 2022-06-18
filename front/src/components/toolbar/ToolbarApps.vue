<template>
  <v-menu offset-y left transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-btn color="white" class="ml-1" icon v-on="on">
        <v-icon size="28">mdi-dots-grid</v-icon>
      </v-btn>
    </template>

    <v-card class="d-flex flex-row flex-wrap" style="max-width: 280px">
      <span
        class="modulo"
        v-for="(item, index) in items"
        :key="index"
        @click="redirect($event, item.link)"
      >
        <div
          class="item-tile pa-1 text-center d-flex flex-columm"
          style="flex: 0 50%"
        >
          <v-img
            width="36px"
            height="36px"
            v-permissions_system="item.codigo"
            :src="`${item.icone}`"
          ></v-img>

          <div class="font-weight-bold mt-1 ml-2">
            <span class="item-descricao">
              {{ item.descricao }}
            </span>
          </div>
        </div>
      </span>
    </v-card>
  </v-menu>
</template>

<script>
import jwt from "../../api/jwt";
import config from "../../configs";
import { mapGetters } from "vuex";

/*
|---------------------------------------------------------------------
| Toolbar Apps Component
|---------------------------------------------------------------------
|
| Quickmenu for applications in the toolbar
|
*/
export default {
  data() {
    return {
      apps: config.toolbar.apps,
      items: [],
    };
  },
  mounted() {},
  methods: {
     redirect(event, link) {
      event.ctrlKey ? window.open(link, '_blank') : window.location = link;

    },
    navigateTo(path) {
      return (window.location.href = `${path}/autenticar?token=${jwt.getToken()}`);
      //if (this.$route.path !== path) this.$router.push(path);
    },
  },
  computed: {
    ...mapGetters({
      permissions: "$_login/getUsuarioPermissoes",
    }),
  },
  watch: {
    permissions(value) {
      this.items = value.systems;
    },
  },
};
</script>

<style lang="scss" scoped>
.app-tile {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  cursor: pointer;
  border-radius: 6px;
  background-color: var(--v-background-base);
  transition: transform 0.2s;

  &:hover {
    transform: scale(1.1);
  }
}
.v-toolbar__content {
  padding: 1px 6px;
}

.item-descricao {
  color: #393e46;
}

.modulo {
  cursor: pointer;
}
</style>
