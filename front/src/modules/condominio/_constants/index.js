const routeMain = "condominios";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const form = {
  id: null,
  nome: "",
  valor_avista: "",
  valor_cartao: "",
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
    text: "Condomínios",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Condomínios",
    disabled: false,
    to: "/condominios",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsShow = [
  {
    text: "Condomínios",
    disabled: false,
    to: "/condominios",
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
  { text: "Valor à vista", value: "valor_avista", align: "left" },
  { text: "Valor em cartão", value: "valor_cartao", align: "left" },
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
