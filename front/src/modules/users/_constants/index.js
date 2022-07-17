const routeMain = "users";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const form = {
  id:null,
  password: null,
  name: "",
  email: "",
};

const breadcrumbsIndex = [
  {
    text: "Perfil",
    disabled: false,
    href: "#",
  },
  {
    text: "Editar",
  },
];

export const constants = {
  routeMain,
  state,
  form,
  breadcrumbsIndex,
};
