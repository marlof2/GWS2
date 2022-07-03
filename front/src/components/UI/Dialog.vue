<template>
  <v-dialog v-model="localValue" persistent :max-width="maxWidth">
    <v-card>
      <v-toolbar class="elevation-0">
        <v-toolbar-items class="flex-toolbar-dialog">
          <v-toolbar-title>{{ title }} </v-toolbar-title>
          <v-icon @click="closeClick">mdi-close</v-icon>
        </v-toolbar-items>
      </v-toolbar>
      <v-container>
        <slot></slot>
      </v-container>
      <v-card-actions>
        <v-spacer></v-spacer>
        <FormButton
          :small="true"
          dark
          :label="'Cancelar'"
          @click="closeClick"
          :background="this.$colors.btn_voltar"
        />
        <FormButton
          v-if="!isDelete"
          dark
          :small="true"
          :label="'Salvar'"
          @click="saveClick"
        />
        <FormButton
          v-if="isDelete"
          dark
          :small="true"
          :label="'Excluir'"
          @click="deleteClick"
          :background="'#be5b59'"
        />
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import FormButton from "./FormButton.vue";
export default {
  components: {
    FormButton,
  },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    maxWidth: {
      type: Number,
      default: 580,
    },
    title: {
      type: String,
      default: "",
    },
    isDelete: {
      type: Boolean,
      default: false,
    },
    saveClick: {
      type: Function,
      default: () => {},
    },
    closeClick: {
      type: Function,
      default: () => {},
    },
    deleteClick: {
      type: Function,
      default: () => {},
    },
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>
