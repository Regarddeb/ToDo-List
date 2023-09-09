/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        poppins: ['Poppins', 'sans'],
      },
    },
    fontFamily: {
      poppins_reg: ['poppins_reg', 'sans-serif'],
      poppins_bold: ['poppins_bold', 'sans-serif'],
      poppins_light: ['poppins_light', 'sans-serif']
  }
  },
  plugins: [
    //require('@tailwindcss/forms'),
  ],
}