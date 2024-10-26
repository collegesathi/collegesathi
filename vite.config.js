import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  build: {
    rollupOptions: {
      input: './resources/views/welcome.blade.php',  // Define the HTML or Blade file
    }
  },
  resolve: {
    alias: {
      '@': '/resources/js',  // Define alias to your 'resources/js' folder
    },
  },
  optimizeDeps: {
    include: ['vue'],  // Include Vue.js for pre-bundling
  },
  root: 'resources',  // Ensure Vite understands the root of your project
});
