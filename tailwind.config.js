/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.{html,js,php}',
    './views/*.{html,js,php}', 
    './views/auth/*.{html,js,php}',
    './views/templates/*.{html,js,php}',
    './views/cita/*.{html,js,php}',
    './views/admin/*.{html,js,php}',
    './views/servicios/*.{html,js,php}',
    './public/js/*{html,js,php}'
  ],
  theme: {
    backgroundImage: {
      'hero-pattern': "url('/img/fondo.png')"
    },
    fontFamily: {
      'poppins': ['Poppins', 'sans-serif']
    }
  },
  plugins: [],
}

