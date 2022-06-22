export default [
  {
    path: "/produtos",
    name: "produtos",
    component: () => import("@/modules/produto"),
  },
  {
    path: "/produtos/cadastrar",
    name: "produto-cadastrar",
    component: () => import("@/modules/produto/_components/form"),
  },
  {
    path: "/produtos/editar/:id",
    name: "produto-editar",
    component: () => import("@/modules/produto/_components/form"),
  },
  {
    path: "/produtos/visualizar/:id",
    name: "produto-visualizar",
    component: () => import("@/modules/produto/_components/show"),
  },
];