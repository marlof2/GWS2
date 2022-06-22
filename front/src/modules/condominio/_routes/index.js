export default [
  {
    path: "/condominios",
    name: "condominios",
    component: () => import("@/modules/condominio"),
  },
  {
    path: "/condominios/cadastrar",
    name: "condominio-cadastrar",
    component: () => import("@/modules/condominio/_components/form"),
  },
  {
    path: "/condominios/editar/:id",
    name: "condominio-editar",
    component: () => import("@/modules/condominio/_components/form"),
  },
  {
    path: "/condominios/visualizar/:id",
    name: "condominio-visualizar",
    component: () => import("@/modules/condominio/_components/show"),
  },
];
