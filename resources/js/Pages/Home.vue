<template>
  <div class="min-h-screen bg-white text-gray-800">

    <NavBarre/>
<!-- je dois ajouter slider-->
    <section class="relative bg-cover bg-center h-[400px] flex items-center justify-center text-center text-white transition-all duration-1000" :style="`background-image: url(${images[currentImageIndex]})`">
      <div class="absolute inset-0 pointer-events-none "
          style="background: linear-gradient(to bottom, rgba(76,100,68,0.05) 0%, rgba(76,100,68,0.85) 120%); border-radius: 0rem;">
      </div>
      
      <div class="relative p-1 font-Ledger pl-2 z-10">
        <h2 class="text-3xl md:text-4xl  mb-2 pl-1" style="font-family: 'Jeju Myeongjo', serif;">
          Decouvrez notre collection tendance d’accessoires.
        </h2>
        <p class="text-md md:text-lg">Soyez stylé(e) chaque jour ,Commandez en ligne facilement !</p>
        <p class="text-md md:text-lg">Femme - Homme - Enfant | Livraison partout au Maroc</p>
      </div>

      <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
        <span v-for="(images, index) in images" :key="index" class="w-3 h-3 rounded-full transition-all duration-300"
        :class="currentImageIndex === index ? 'bg-[#4C6444]' : 'bg-white opacity-50'">
        </span>
      </div>
    </section>

    <!-- Produits en vedette -->
    <section class="py-12 px-4">
      <h3 class="text-2xl font-bold mb-6 text-center">Nos Sélections</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <ProductCard v-for="product in products" :key="product.id" :product="product" />
      </div>
    </section>
        <Footer />
  </div>
</template>

<script setup>
import NavBarre from '@/Components/NavBarre.vue';
import ProductCard from '@/Components/ProductCard.vue';
import {ref , onMounted} from 'vue';
import Footer from '@/Components/Footer.vue';
const images=[
  '/img/slider1.jpg',
  '/img/slider2.jpg',
  '/img/slider3.jpg'
];
const currentImageIndex = ref(0);
onMounted(() => {
  setInterval(() => {
    currentImageIndex.value = (currentImageIndex.value + 1) % images.length;
  }, 3000); //pour changer images chaque 3s
});
const products = [
  { id: 1, name: '5 collier', price: '155 DH', image: '/img/produit1.jpg' },
  { id: 2, name: 'Montre rolex', price: '499 DH', image: '/img/produit2.jpg' },
  { id: 3, name: 'fillottes Rose', price: '15 DH', image: '/img/produit3.jpg' },
  { id: 4, name: 'Montre Femme', price: '299 DH', image: '/img/produit1.jpg' },
  { id: 5, name: 'Sac Cuir', price: '499 DH', image: '/img/produit2.jpg' },
  { id: 6, name: 'Lunettes Homme', price: '199 DH', image: '/img/produit3.jpg' },
  { id: 7, name: 'Montre Femme', price: '299 DH', image: '/img/produit1.jpg' },
  { id: 8, name: 'Sac Cuir', price: '499 DH', image: '/img/produit2.jpg' },
  { id: 9, name: 'Lunettes Homme', price: '199 DH', image: '/img/produit3.jpg' }
]
</script>
