/* eslint-disable @typescript-eslint/no-require-imports */
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.jsx',
    './resources/**/*.ts',
    './resources/**/*.tsx',
    './node_modules/preline/preline.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
      },
      colors: {
        primary: {
          DEFAULT: '#3D83DF',
          hover: '#3573c5',
        },
      },
    },
  },
  plugins: [require('@tailwindcss/forms'), require('preline/plugin')],
};
