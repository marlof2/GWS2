export default [
  {
    path: "/programacao",
    name: "programacao",
    component: () => import("@/modules/programacao"),
  },
  {
    path: "/programacao/cadastrar",
    name: "programacao-cadastrar",
    component: () => import("@/modules/programacao/_components/form"),
  },
  {
    path: "/programacao/editar/:id",
    name: "programacao-editar",
    component: () => import("@/modules/programacao/_components/form"),
  },
  {
    path: "/programacao/visualizar/:id",
    name: "programacao-visualizar",
    component: () => import("@/modules/programacao/_components/form"),
  },
];