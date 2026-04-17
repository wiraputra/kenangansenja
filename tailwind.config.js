/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          light: '#d4a373',
          DEFAULT: '#c69466',
          dark: '#8e6642',
        },
        espresso: {
          50: '#f6f5f4',
          100: '#eceae8',
          200: '#d9d5d1',
          300: '#bcb3ab',
          400: '#9b8c80',
          500: '#806f62',
          600: '#67584e',
          700: '#564941',
          800: '#483f38',
          900: '#1a1816',
          950: '#0d0c0b',
        }
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        header: ['Syne', 'sans-serif'],
      },
    },
  },
  plugins: [],
}