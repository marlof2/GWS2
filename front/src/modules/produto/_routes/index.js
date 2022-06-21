export default [
  {
    path: "/produtos",
    name: "produtos",
    component: () => import("@/modules/produto"),
  },
  {
    path: "/produto/cadastrar",
    name: "produto-cadastrar",
    component: () => import("@/modules/produto/_components/form"),
  },
  {
    path: "/produto/editar/:id",
    name: "produto-editar",
    component: () => import("@/modules/produto/_components/form"),
  },
  {
    path: "/produto/visualizar/:id",
    name: "produto-visualizar",
    component: () => import("@/modules/produto/_components/show"),
  },
];