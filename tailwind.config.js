/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}", "./*.html"],
  theme: {
    extend: {
      colors: {
        sage: "#6F7C6B",
        beige: "#E6DDCE",
        cream: "#F3EBDD",
        olive: "#5E6B59",
        medical: "#E58A4A",
        forest: "#4F5C4C",
      },
      fontFamily: {
        sans: ["Inter", "Roboto", "Outfit", "sans-serif"],
        serif: ["Playfair Display", "Merriweather", "serif"],
      },
    },
  },
  plugins: [],
};
