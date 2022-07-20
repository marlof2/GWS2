export default [
  {
    path: "/cliente",
    name: "cliente",
    component: () => import("@/modules/cliente"),
  },
  {
    path: "/cliente/cadastrar",
    name: "cliente-cadastrar",
    component: () => import("@/modules/cliente/_components/form"),
  },
  {
    path: "/cliente/editar/:id",
    name: "cliente-editar",
    component: () => import("@/modules/cliente/_components/form"),
  },
  {
    path: "/cliente/visualizar/:id",
    name: "cliente-visualizar",
    component: () => import("@/modules/cliente/_components/show"),
  },
];
