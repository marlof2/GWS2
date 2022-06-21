import menuPages from "./menus/pages.menu";

export default {
  // main navigation - side menu
  menu: [
    {
      text: "Painel de Controle",
      items: [
        {
          icon: "mdi-home",
          key: "Início",
          text: "Início",
          link: "/pagina-inicial",
        },
        {
          icon: "mdi-clipboard-list-outline",
          key: "Programação",
          text: "Programação",
          link: "/programacao",
        },
        {
          icon: "mdi-archive-outline",
          key: "Produtos",
          text: "Produtos",
          link: "/produtos",
        },
        {
          icon: "mdi-home-city-outline",
          key: "Condominios",
          text: "Condominios",
          link: "/condominio",
        },
        {
          icon: "mdi-account-group-outline",
          key: "Usuarios",
          text: "Usuarios",
          link: "/usuario",
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
