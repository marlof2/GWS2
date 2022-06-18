import menuPages from "./menus/pages.menu";

export default {
  // main navigation - side menu
  menu: [
    {
      text: "Painel de Controle",
      items: [
        {
          icon: "mdi-file-outline",
          key: "Início",
          text: "Início",
          link: "/pagina-inicial",
        },
        {
          icon: "mdi-file-outline",
          key: "Produtos",
          text: "Produtos",
          link: "/produto",
        },
        {
          icon: "mdi-file-outline",
          key: "Condominios",
          text: "Condominios",
          link: "/condominio",
        },
        {
          icon: "mdi-file-outline",
          key: "Usuarios",
          text: "Usuarios",
          link: "/usuario",
        },
        {
          icon: "mdi-file-outline",
          key: "Programação",
          text: "Programação",
          link: "/programacao",
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
