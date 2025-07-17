<template>
  <div class="min-h-screen bg-white text-gray-800">

    <NavBarre/>

     <RecommandationSection/>
  

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
import RecommandationSection from '@/Components/RecommandationSection.vue';
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
  }, 3000); //pour changer l'images entr chaque 3s
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
