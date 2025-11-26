/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        // Primary brand colors
        'zenrows-green': '#22C55E',
        'zenrows-green-hover': '#16A34A',
        'zenrows-green-light': '#DCFCE7',
        // Disabled state
        'zenrows-disabled': '#F1A29A',
        // Selection border
        'zenrows-selection': '#818CF8',
        'zenrows-selection-light': '#E0E7FF',
        // Card colors
        'zenrows-card-border': '#E5E7EB',
        'zenrows-card-hover': '#F9FAFB',
        // Text colors
        'zenrows-text': '#1F2937',
        'zenrows-text-secondary': '#6B7280',
        // Dark theme (footer)
        'zenrows-dark': '#111827',
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
      boxShadow: {
        'selection': '0 0 0 3px rgba(129, 140, 248, 0.3)',
        'card': '0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)',
      },
    },
  },
  plugins: [],
}

