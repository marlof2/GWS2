const routeMain = "users";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const form = {
  user_key: null,
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
