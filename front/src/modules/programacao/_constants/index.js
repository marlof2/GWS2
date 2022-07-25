const routeMain = "programacao";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];
state[`flagAtender`] = { flag: false };
state[`flagNaoAtender`] = { flag: false };
state[`flagImprimir`] = { flag: false };
state[`flagComprovante`] = { flag: false };
// state[`createUpload`] = [];

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
  data: null,
  hora: null,
  valor: null,
  situacao: 'N',
  descricao: null,
  observacao: null,
  garantia: null,
  forma_pagamento_id: null,
  condominium_id: null,
  user_id: null,
  client_id: null,
};
const formStep3 = {
  programation_id: null,
  product_id: null,
  quantidade: null,
};

const tblProducts = {
  dialog: false,
  dialogDelete: false,
  headers: [
    {
      text: "Item",
      value: "nome",
      align: "left",
    },
    { text: "Quantidade", value: "quantidade", align: "left" },
    { text: "Ações", value: "actions", sortable: false },
  ],
  isEdit: false,
};

const tblUpload = {
  programation_id: null,
  dialog: false,
  dialogDelete: false,
  headers: [
    { text: "Nome", value: "name", align: "left" },
    { text: "Ações", value: "actions", sortable: false },
  ],
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
  { text: "Id", value: "id", align: "left" },
  { text: "Cliente", value: "cliente.nome", align: "left" },
  { text: "Condomínio", value: "condominio.nome", align: "left" },
  { text: "Data", value: "data", align: "left" },
  { text: "Hora", value: "hora", align: "left" },
  { text: "Situação", value: "situacao", align: "left" },
  { text: "Funcionário", value: "user.name", align: "left" },
  { text: "Ação", value: "acao" },
];

const customItemsProp = [
  {
    id: 1,
    name: "data",
    filter: "dateformat",
  },
  {
    id: 2,
    situacao: true,
  },
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
  tblProducts,
  customItemsProp,
  tblUpload,
};
