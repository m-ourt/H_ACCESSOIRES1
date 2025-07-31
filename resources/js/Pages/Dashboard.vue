<template>
  <div class="min-h-screen bg-white text-gray-800">
    <WelcomeLabel 
      v-if="showWelcome"
      :user="user"
      :is-new-user="isNewUser"
      @welcome-closed="onWelcomeClosed"
    />
    <NavBarre/>

     <RecommandationSection/>
  

    <!-- Produits en vedette -->
    <section class="py-12 px-4">
      <h3 class="text-2xl font-bold mb-6 text-center">Nos Sélections</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <ProductCard 
        v-for="product in products" 
        :key="product.id" 
        :product="product"
         />
      </div>
    </section>
        <Footer />
  </div>
</template>

<script setup>
import RecommandationSection from '@/Components/RecommandationSection.vue';
import NavBarre from '@/Components/NavBarre.vue';
import WelcomeLabel from '@/Components/WelcomeLabel.vue'
import ProductCard from '@/Components/ProductCard.vue';
import {ref , onMounted} from 'vue';
import Footer from '@/Components/Footer.vue';
// Props
const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  isNewUser: {
    type: Boolean,
    default: false
  },
  products: Array
});
const showWelcome = ref(true);

function onWelcomeClosed() {
  showWelcome.value = false;
}




</script>