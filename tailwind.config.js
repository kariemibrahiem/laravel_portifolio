/** @type {import('tailwindcss').Config} */
module.exports = {
  // اللي Tailwind يقرأه عشان يطلع classes المستخدمة بس
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],

  theme: {
    extend: {
      // Breakpoints بتاعتك (بديل @theme)
      screens: {
        xxs: "21.25rem", // 340px
        xs: "23.125rem", // 363px
        xxl: "82.5rem",  // 1320px
      },

      // ألوانك (عشان تستخدم bg-picto-primary بدل var)
      colors: {
        "picto-primary": "#9929fb",
        "picto-primary-dark": "#650fa0",
        "soft-white": "#f0f1f3",
        "soft-dark": "#87909d",
      },
    },
  },

  plugins: [require("daisyui")],

  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
};
