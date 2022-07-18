const routeMain = "users";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const form = {
  id: null,
  name: "",
  email: "",
  password: process.env.VUE_APP_PASSWORD
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
    text: "Usuário",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Usuário",
    disabled: false,
    to: "/users",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsShow = [
  {
    text: "Usuário",
    disabled: false,
    to: "/users",
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
  { text: "Nome", value: "name", align: "left" },
  { text: "Email", value: "email", align: "left" },
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
