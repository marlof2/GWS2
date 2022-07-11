<template>
  <div>
    <v-row cols="12" dense class="py-2">
      <v-col cols="6">
        <span>
          <AddButton
            v-permissions="permissions.incluir"
            :currentRoutePath="this.$router.currentRoute.path"
          />
        </span>
      </v-col>
      <v-col cols="6">
        <v-text-field
          v-model="searchQuery"
          append-icon="mdi-magnify"
          @click:append="handleSearch()"
          solo
          flat
          hide-details
          dense
          clearable
          placeholder="Buscar"
          @keyup.enter="handleSearch()"
          class="search-input"
        ></v-text-field>
      </v-col>
      <!-- <div>
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-on="on"
              v-bind="attrs"
              color="grey"
              dark
              @click.stop="handleDrawer()"
              ><v-icon size="16">mdi-filter</v-icon></v-btn
            >
          </template>
          <span>Filtro Avançado</span>
        </v-tooltip>
      </div> -->
    </v-row>
    <v-data-table
      :headers="headers"
      :items="items"
      class="elevation-0"
      :items-per-page="itemsPerPage"
      hide-default-footer
    >
      <template v-slot:[`item.situacao`]="{ item }">
        <v-chip  v-if="customItemsProp[0].situacao" :color="getColor(item.situacao)" dark>
          {{ item.situacao == "N" ? "Não Atendido" : "Atendido" }}
        </v-chip>
      </template>

      <template
        v-for="customItem in customItemsProp"
        v-slot:[`item.${customItem.name}`]="{ item }"
      >
        <div :key="customItem.id">
          <div v-if="customItem.filter === 'lowercase'">
            {{ `${item[customItem.name]}` | lowercase }}
          </div>
          <div v-if="customItem.filter === 'uppercase'">
            {{ `${item[customItem.name]}` | uppercase }}
          </div>
          <div
            v-if="customItem.filter === 'dateformat' && item[customItem.name]"
          >
            {{ `${item[customItem.name]}` | dateformat }}
          </div>
        </div>
      </template>
      <template col-1 v-slot:[`item.acao`]="{ item }">
        <ActionInline
          :permissions="permissions"
          :item="item"
        />
        <MaisOpcoesTable :idUser="item.id" />
      </template>
    </v-data-table>
    <div class="pt-2 d-flex flex-row align-items-flex-start justify-center">
      <span class="d-flex mt-2">
        <v-btn
          class="v-pagination__item btn-custom"
          :disabled="page === 1"
          @click="handleFirstPage"
        >
          <v-icon size="16">mdi-arrow-collapse-left</v-icon>
        </v-btn>
        <v-pagination
          v-model="page"
          :length="pageCount"
          @input="handlePageChange"
          total-visible="5"
          :items-per-page="itemsPerPage"
          :color="'primary'"
        >
        </v-pagination>
        <v-btn
          class="v-pagination__item btn-custom"
          :disabled="page === pageCount"
          @click="handleLastPage"
        >
          <v-icon size="16">mdi-arrow-collapse-right</v-icon>
        </v-btn>
      </span>
    </div>
    <!-- <div class="mt-2 d-flex flex-row align-items-flex-start justify-center">
      <SelectAutocomplete
        v-model="page"
        class="select-custom text-center"
        :items="countPages()"
        :label="'Paginação'"
        @input="handlePageChange"
        :fields="[]"
        pagination
      />
    </div> -->
  </div>
</template>

<script>
import CopyLabel from "./CopyLabel.vue";
import AddButton from "./AddButton.vue";
import ActionInline from "./ActionInlineTable.vue";
import MaisOpcoesTable from "../UI/ActionTableMoreOptions.vue";
import SelectAutocomplete from "../Inputs/SelectAutocomplete.vue";

export default {
  components: {
    CopyLabel,
    AddButton,
    ActionInline,
    MaisOpcoesTable,
    SelectAutocomplete,
  },
  props: {
    pageProp: {
      type: Number,
      default: 1,
    },
    lastPageProp: {
      type: Number,
      default: 1,
    },
    itemsPerPageProp: {
      type: Number,
      default: 10,
    },
    customItemsProp: {
      type: Array,
      default: () => [],
    },
    headersProp: {
      type: Array,
      default: () => [],
    },
    dataProp: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: "",
    },
    permissions: {
      type: Object,
      default: () => {},
    },
  },
  mounted() {
    this.headers = this.headersProp;
    this.items = this.dataProp;
    this.page = this.pageProp;
    this.itemsPerPage = this.itemsPerPageProp;
    this.$root.$on("resetPage", () => (this.page = 1));
  },
  data() {
    return {
      headers: [],
      items: [],
      page: 0,
      pageCount: 0,
      itemsPerPage: 0,
      searchQuery: "",
      counter: 0,
      drawer: null,
    };
  },
  methods: {
    async handlePageChange() {
      const paginate = { page: this.page, per_page: this.itemsPerPage };
      this.$emit("handlePageChange", paginate);
    },
    async handleFirstPage() {
      const paginate = { page: 1, per_page: this.itemsPerPage };
      this.page = 1;
      this.$emit("handlePageChange", paginate);
    },
    async handleLastPage() {
      const paginate = { page: this.pageCount, per_page: this.itemsPerPage };
      this.page = this.pageCount;
      this.$emit("handlePageChange", paginate);
    },
    async handleSearch() {
      this.$emit("handleSearch", this.searchQuery);
      this.searchQuery = "";
    },
    // async handleDrawer() {
    //   this.$emit("handleDrawer", true);
    // },
    countPages() {
      let i = 0;
      let array = [];
      while (i < this.pageCount) {
        i++;
        array.push(i);
      }
      return array;
    },
    getColor(situacao) {
      if (situacao == "A") {
        return "success";
      } else {
        return "error";
      }
    },
  },
  watch: {
    dataProp: function (value) {
      this.items = value;
    },
    lastPageProp: function (value) {
      this.pageCount = value;
    },
  },
};
</script>

<style scoped>
::v-deep.v-data-table table tbody tr:nth-of-type(even) {
  background-color: rgba(236, 237, 237, 0.4);
}

.select-custom {
  max-width: 10%;
}

.btn-custom {
  min-width: 30px !important;
}

.search-input {
  border: 1px solid #a9aab1;
}
</style>
