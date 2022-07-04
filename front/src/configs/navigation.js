import menuPages from "./menus/pages.menu";

export default {
  // main navigation - side menu
  menu: [
    {
      text: "Painel de Controle",
      items: [
        {
          icon: "mdi-home",
          text: "Início",
          link: "/pagina-inicial",
        },
        {
          icon: "mdi-clipboard-list-outline",
          text: "Programação",
          link: "/programacao",
        },
        {
          icon: "mdi-archive-outline",
          text: "Produtos",
          link: "/produtos",
        },
        {
          icon: "mdi-home-city-outline",
          text: "Condominios",
          link: "/condominios",
        },
        {
          icon: "mdi-account-supervisor-outline",
          text: "Usuarios",
          link: "/usuario",
        },
        {
          icon: "mdi-account-group-outline",
          text: "Clientes",
          link: "/clientes",
        },
        {
          icon: "mdi-file-chart-outline",
          text: "Relatório",
          link: "/clientes",
        },
      ],
    },
    // {
    //   text: "Pages",
    //   key: "menu.pages",
    //   items: menuPages,
    // },
  ],
};
