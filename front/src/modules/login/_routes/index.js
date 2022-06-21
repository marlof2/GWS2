export default [
  {
    path: "/autenticar",
    name: "autenticar",
    component: () => import("@/modules/login"),
    meta: {
      layout: 'auth'
    }
  },
  // {
  //   path: "/login/cadastrar",
  //   name: "login-cadastrar",
  //   component: () => import("@/modules/login/_components/form"),
  // },
  // {
  //   path: "/login/editar/:id",
  //   name: "login-editar",
  //   component: () => import("@/modules/login/_components/form"),
  // },
  // {
  //   path: "/login/visualizar/:id",
  //   name: "login-visualizar",
  //   component: () => import("@/modules/login/_components/form"),
  // },
];
