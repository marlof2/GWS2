const routeMain = "programations";

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
  data_hora: null,
  valor: null,
  situacao: 'N',
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
  quantidade: null
};

const tblProducts = {
  products:[],
  allProducts:[{nome:'Marlo', quantidade:10}],
  programation_id: null,
  product_id: null,
  quantidade: null,
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
  editedIndex: -1,
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
  { text: "Nome", value: "cliente.nome", align: "left" },
  { text: "Condomínio", value: "condominio.nome", align: "left" },
  { text: "Data/Hora", value: "data_hora", align: "left" },
  { text: "Situação", value: "situacao", align: "left" },
  { text: "Funcionário", value: "user.name", align: "left" },
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
  tblProducts,
};
