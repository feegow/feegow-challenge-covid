import path from 'path';

import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';


export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/main.tsx'],
      refresh: true,
    }),
    react(),
  ],
  resolve: {
    alias: {
      // eslint-disable-next-line no-undef
      '@': path.resolve(__dirname, './resources/js/src'),
    },
  },
  server: {
    hmr: {
      host: 'localhost',
    },
  },
});
