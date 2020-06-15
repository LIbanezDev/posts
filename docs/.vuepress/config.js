module.exports = {
  title: 'Posts',
  description: 'My project',
  base:'.',
  themeConfig: {
    logo: './img/php.png',
    nav: [
      { text: 'Inicio', link: '/' },
      { text: 'Repositorio', link: 'https://github.com/Fromiti/posts', target:'_blank'}
    ],
    sidebar: [
      {
        title: 'Primeros Pasos',   // required
        path: '/',      // optional, link of the title, which should be an absolute path and must exist
        collapsable: false, // optional, defaults to true
        sidebarDepth: 2,    // optional, defaults to 1
        children: [
          '/',
        ]
      },
      {
        title: 'FrontEnd',   // required
        path: '/frontend/',      // optional, link of the title, which should be an absolute path and must exist
        collapsable: false, // optional, defaults to true
        sidebarDepth: 2,    // optional, defaults to 1
        children: [
          '/frontend/',
          '/frontend/segmentacion',
        ]
      },
      {
        title: 'BackEnd ',
        path: '/backend/',
        collapsable: false, // optional, defaults to true
        sidebarDepth: 2,    // optional, defaults to 1
        children: [
          '/backend/',
        ]
      }
    ]
  }
}