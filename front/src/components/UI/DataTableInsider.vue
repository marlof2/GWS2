<template>
  <v-data-table
    disable-pagination
    :headers="headers"
    :items="items"
    hide-default-footer
    style="height: auto"
  >
    <template v-slot:top>
      <slot name="top"></slot>
    </template>
    <template v-slot:[`item.actions`]="{ item }">
      <span class="icons">
        <v-tooltip v-if="hideBtnEdit" bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-permissions="permissions ? permissions.alterarInseder : ''"
              @click="onClickEdit(item)"
              icon
              color="#5abf7a"
              :disabled="disabled"
            >
              <v-icon size="26" v-on="on" v-bind="attrs">
                mdi-pencil-circle-outline</v-icon
              >
            </v-btn>
          </template>
          <span>Editar</span>
        </v-tooltip>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-permissions="permissions ? permissions.excluirInseder : ''"
              @click="onClickDelete(item)"
              icon
              color="#be5b59"
              :disabled="disabled"
            >
              <v-icon size="26" v-on="on" v-bind="attrs"
                >mdi-trash-can-outline</v-icon
              >
            </v-btn>
          </template>
          <span>Excluir</span>
        </v-tooltip>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-permissions="permissions ? permissions.excluirInseder : ''"
              @click="onClickDownload(item)"
              icon
              color="blue"
              :disabled="disabled"
            >
              <v-icon size="26" v-on="on" v-bind="attrs"
                >mdi-download</v-icon
              >
            </v-btn>
          </template>
          <span>Download</span>
        </v-tooltip>
      </span>
    </template>
  </v-data-table>
</template>
<script>
export default {
  methods: {
    async onClickEdit(item) {
      this.$emit("onClickEdit", item);
    },
    async onClickDelete(item) {
      this.$emit("onClickDelete", item);
    },
    async onClickDownload(item) {
      this.$emit("onClickDownload", item);
    },
  },
  mounted() {},
  props: {
    headers: {
      type: Array,
      default: () => [],
    },
    items: {
      type: Array,
      default: () => [],
    },
    edit: {
      type: Function,
      default: () => {},
    },
    deleteAction: {
      type: Function,
      default: () => {},
    },
    permissions: {
      type: Object,
      default: () => {},
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    hideBtnEdit: {
      type: Boolean,
      default: true,
    },
  },
};
</script>
