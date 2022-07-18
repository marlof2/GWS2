import menu from './menus/menu'

export default {
  // main navigation - side menu
  menu: [
    {
      text: 'Agenda',
      key: 'menu.agenda',
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
          icon: "mdi-calendar-check-outline",
          text: "Visitação",
          link: "/Visitação",
        },
      ],
    },
    {
      text: 'Administrativo',
      key: 'menu.admin',
      items: [
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
          link: "/users",
        },
        {
          icon: "mdi-account-group-outline",
          text: "Clientes",
          link: "/cliente",
        },
        {
          key: '',
          text: 'Relatório',
          icon: "mdi-file-chart-outline",
          items: [
            { text: 'Faturamento', link: '/relatorio' },
          ]
        },
      ],
    },
  ],
}
