import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  root: './assets',
  base: '/assets',
  build: {
    manifest: true,
    assetsDir: '',
    outDir: '../public/assets/',
    rollupOptions: {
      input: {
        'main.ts': './assets/main.ts'
      }
    }
  }
})
