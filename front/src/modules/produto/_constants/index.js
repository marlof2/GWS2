const routeMain = "produto";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const form = {
  id: null,
  nome: "",
  nacionalidade: "",
  codigo_m49: "",
  codigo_iso_alpha2: "",
  codigo_iso_alpha3: "",
  codigo_esus: "",
};

const permissions = {
  incluir: "",
  alterar: "",
  excluir: "",
  visualizar: "",
  listar: "",
};

const breadcrumbsIndex = [
  {
    text: "Produtos",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Produtos",
    disabled: false,
    to: "/produto",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsShow = [
  {
    text: "Produtos",
    disabled: false,
    to: "/produto",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const paginate = {
  totalPages: 0,
  page: 1,
  lastPage: null,
  perPages: 15,
};

const headers = [
  { text: "Nome", value: "nome", align: "left" },
  { text: "Quantidade", value: "quantidade", align: "left" },
  { text: "Ação", value: "acao" },
];

export const constants = {
  routeMain,
  state,
  form,
  breadcrumbsIndex,
  breadcrumbsForm,
  breadcrumbsShow,
  paginate,
  headers,
  permissions,
};
