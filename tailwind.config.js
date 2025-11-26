/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/Livewire/**/*.php", // PENTING: Agar class di file Livewire terbaca
  ],
  theme: {
    extend: {
      colors: {
        // Palet Warna Hijau Khas Pesantren
        pesantren: {
          50: '#ecfdf5',  // Background tipis
          100: '#d1fae5',
          primary: '#10b981', // Hijau Utama (Emerald-500)
          hover: '#047857',   // Hijau saat di-hover (Emerald-700)
          dark: '#064e3b',    // Hijau Tua untuk Sidebar/Footer (Emerald-900)
        },
        gold: '#fbbf24', // Warna emas untuk aksen
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'], // Nanti kita load font ini di layout
      },
    },
  },
  plugins: [],
}