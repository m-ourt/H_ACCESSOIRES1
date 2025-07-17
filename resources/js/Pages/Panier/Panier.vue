<script setup>
import Navbar from '@/Components/Navbarre.vue'
import Footer from '@/Components/Footer.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  cartItems: Array,
})

function supprimerProduit(id) {
  router.delete(`/cart/delete/${id}`, {
    onSuccess: () => {
      console.log('Produit supprimé')
    }
  })
}


function changerQuantite(item, type) {
  let newQty = item.quantity
  if (type === 'plus') newQty++
  if (type === 'minus' && item.quantity > 1) newQty--

  router.patch(`/cart/update/${item.id}`, {
    quantity: newQty,
  }, {
    onSuccess: () => {
      console.log('Quantité mise à jour')
    }
  })
}
</script>


<template>
  <div class="min-h-screen flex flex-col justify-between bg-white text-[#102820]">
   
    <Navbar />

    
    <main class="flex-1 px-6 py-10">
      <h1 class="text-3xl font-bold text-[#4C6444] mb-6">Mon Panier</h1>

     
      <div v-if="cartItems.length" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="item in cartItems"
          :key="item.id"
          class="bg-[#CABA9C] rounded-lg shadow-md overflow-hidden flex flex-col"
        >
          <img :src="item.product.image" :alt="item.product.name" class="w-full h-48 object-cover" />

          <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
              <h2 class="text-xl font-semibold mb-2">{{ item.product.name }}</h2>
              <p class="text-[#4C6444] font-bold mb-4">{{ item.product.price }}</p>
               <div class="flex items-center gap-2">
                <button @click="changerQuantite(item, 'minus')" class="bg-[#4D2D18] text-white px-2 rounded">−</button>
                <span class="font-bold text-lg">{{ item.quantity }}</span>
                <button @click="changerQuantite(item, 'plus')" class="bg-[#4D2D18] text-white px-2 rounded">+</button>
              </div>
            </div>

            <div class="flex justify-between items-center">
              <button @click="supprimerProduit(item.id)" class="text-sm text-red-600 hover:underline">Supprimer</button>

              <button class="bg-[#4C6444] text-white px-3 py-1 rounded hover:bg-[#3c5238]">
                Commander
              </button>
            </div>
          </div>
        </div>
      </div>

     
      <div v-else class="text-gray-500">Votre panier est vide.</div>
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>
