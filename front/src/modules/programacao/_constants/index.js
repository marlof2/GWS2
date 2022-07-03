const routeMain = "programacao";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const formStep1 = {
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
const formStep2 = {
  id: null,
  valor: null,
  situacao: 'N',
  observacao: null,
  garantia: null,
  forma_pagmento_id: null,
  condominium_id: null,
  user_id: null,
  client_id: null,
};
const formStep3 = {
  programation_id: null,
  product_id: null,
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
    text: "Programação",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Programação",
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
    text: "Programação",
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
  formStep1,
  formStep2,
  formStep3,
  breadcrumbsIndex,
  breadcrumbsForm,
  breadcrumbsShow,
  paginate,
  headers,
  permissions,
};
