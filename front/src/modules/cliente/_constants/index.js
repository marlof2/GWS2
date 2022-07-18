const routeMain = "cliente";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];


const permissions = {
  incluir: "",
  alterar: "",
  excluir: "",
  visualizar: "",
  listar: "",
};

const form = {
  id: null,
  nome: null,
  cpf_cnpj: null,
  cep: null,
  endereco: null,
  complemento: null,
  cidade: null,
  bairro: null,
  telefone: null,
  email: null,
};

const breadcrumbsIndex = [
  {
    text: "Cliente",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Cliente",
    disabled: false,
    to: "/cliente",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsShow = [
  {
    text: "Cliente",
    disabled: false,
    to: "/cliente",
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
  { text: "Telefone", value: "telefone", align: "left" },
  { text: "Complemento", value: "complemento", align: "left" },
  // { text: "CPF/CNPJ", value: "cpf_cnpj", align: "left" },
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
