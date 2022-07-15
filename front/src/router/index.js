import Vue from "vue";
import Router from "vue-router";
import Jwt from "../api/jwt";

// Routes
import PagesRoutes from "./pages.routes";
// import UsersRoutes from "@/modules/users/_routes";
import LoginRoutes from "@/modules/login/_routes";
import ProdutosRoutes from "@/modules/produto/_routes";
import CondominioRoutes from "@/modules/condominio/_routes";
import ProgramacaoRoutes from "@/modules/programacao/_routes";

Vue.use(Router);

export const routes = [
  ...ProdutosRoutes,
  ...CondominioRoutes,
  ...LoginRoutes,
  ...PagesRoutes,
  // ...UsersRoutes,
  ...ProgramacaoRoutes,
  {
    path: "/",
    redirect: "/autenticar",
  },
  {
    path: "/autenticar",
    name: "autenticar-user",
    component: () => import("@/modules/login"),
    meta: {
      layout: "auth",
    },
  },
  {
    path: "/pagina-inicial",
    name: "pagina-inicial",
    component: () => import("@/modules/index.vue"),
  },
  {
    path: "*",
    name: "error",
    component: () => import("@/pages/error/NotFoundPage.vue"),
    meta: {
      layout: "error",
    },
  },
];

const router = new Router({
  mode: "history",
  base: process.env.BASE_URL || "/",
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition;

    return { x: 0, y: 0 };
  },
  routes,
});

/**
 * Before each route update
 */
router.beforeEach((to, from, next) => {
  if (to.name === "autenticar" && to.query.token) {
    //verificar token válido antes de setar(backend)
    Jwt.saveToken(to.query.token);
  }
  if (to.name === "autenticar" && Jwt.getToken()) {
    return next("pagina-inicial");
  }
  if (to.name !== "autenticar" && !Jwt.getToken()) {
    // window.localStorage.removeItem("expired_at");
    return next("autenticar");
  }

  return next();
});

/**
 * After each route update
 */
router.afterEach((to, from) => { });

export default router;
