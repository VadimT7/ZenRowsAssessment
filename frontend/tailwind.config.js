/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'zenrows-bg': '#F6F8FB',
        'zenrows-surface': '#FFFFFF',
        'zenrows-border': '#E4E6EE',
        'zenrows-border-strong': '#D4D8F0',
        'zenrows-card-hover': '#FDFBFF',
        'zenrows-selection': '#B6A5FF',
        'zenrows-selection-strong': '#7D6AF5',
        'zenrows-selection-light': '#F2EEFF',
        'zenrows-primary': '#6B5CFF',
        'zenrows-primary-dark': '#5645E2',
        'zenrows-primary-disabled': '#E1DCFF',
        'zenrows-text': '#1E2033',
        'zenrows-text-secondary': '#5D6180',
        'zenrows-success': '#2AC976',
        'zenrows-success-light': '#E6F9F1',
        'zenrows-footer': '#050B13',
        'zenrows-footer-accent': '#0C1421',
        'zenrows-input-border': '#BAC3E2',
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
        serif: ['"Playfair Display"', 'Georgia', 'serif'],
      },
      boxShadow: {
        'selection': '0 0 0 3px rgba(129, 140, 248, 0.3)',
        'card': '0 10px 25px rgba(129, 140, 248, 0.12)',
        'input': '0 12px 35px rgba(89, 70, 227, 0.15)',
      },
    },
  },
  plugins: [],
}

