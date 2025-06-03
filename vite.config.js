import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  server: {
    port: 5174, // Expliciten állítsd be a 5174-es portot
    strictPort: true, // Ne engedje más port használatát
    hmr: {
      host: '192.168.178.100', // Azonos host, mint a Laravel app
      port: 5174, // HMR-hez is ugyanaz a port
    }
  },
  plugins: [
    laravel({
      input: ['resources/js/app.js'],
      refresh: true,
    }),
  ],
});