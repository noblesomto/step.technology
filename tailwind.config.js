/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/exam/**/*.blade.php",
    "./resources/views/dev/**/*.blade.php",
    "./resources/views/frontend/**/*.blade.php",
    "./resources/views/dashboard/**/*.blade.php",
    "./resources/views/backend/**/*.blade.php",
    "./resources/js/app.js",
    "./resources/js/bootstrap.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#B5E93F',
        secondary: {
          100: '#b7eb41',
          200: '#AFD145',
        },
        text: '#4f5962',
        text_darker: '#3b4249',
        text_light: '#949ca5',
        text_red: '#f58d9d',
        featured: '#57c4da',
        dark_green: '#326916',
        button: '#f15e7b',
        body: '#f7f8fa',
        body_light: '#f7f8fa',
        dark: '#3f0000',
        // STEP site tokens (prefixed to avoid colliding with exam's own
        // primary/secondary/body/dark keys above — both domains share this
        // one Tailwind config).
        'step-primary': '#001f66',
        'step-accent': '#48c7ec',
        'step-alert': '#ff2b58',
      },
      fontFamily: {
        body: ['Nunito'],
        roberto: ['Roboto', 'sans-serif'],
        quicksand: ['Quicksand', 'sans-serif'],
        montserrat: ['Montserrat', 'sans-serif'],
        'step-sans': ['Hind', 'sans-serif'],
        'step-heading': ['Poppins', 'sans-serif'],
      },
      height: {
        '128': '32rem',
        '150': '40rem',
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
