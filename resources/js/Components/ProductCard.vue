<template>
  
  <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    
    <img
     :src="`/${product.image}`" 
     :alt="product.name"
      class="w-full h-48 object-cover"
      @error="handleImageError" />
    <div class="p-4 text-[#102820]">
      <h4 class="text-lg font-semibold mb-1">{{ product.name }}</h4>
      <div class="flex items-center justify-between px-4 pb-4">
          <p class="text-[#4C6444] font-bold">{{ product.price }} DH</p>
            <button @click="goToPanier()" class="cursor-pointer text-lg flex items-right gap-1 font-Ledger text-[#4C6444]"> 
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="30" viewBox="0 0 31 24">
	          <path fill="currentColor" d="M19.478 22.099v-.091H13.75v.091l.001.045a1.9 1.9 0 1 1-3.802 0l.001-.047v-.089h-.653a1.22 1.22 0 0 1-1.192-.96l-.001-.008L4.287 2.967l-3.261-.543A1.221 1.221 0 0 1 1.43.017L1.424.016l4.081.68c.497.085.887.461.991.943l.001.008l.692 3.264l11.905.992a6.5 6.5 0 0 0-.112 1.186v.004q0 .604.103 1.179l-.006-.04a1.397 1.397 0 0 0-.951 1.601l-.001-.009l.719 5.19c.044.333.196.625.418.845c.202.201.479.327.786.33h.001q.103 0 .199-.019l-.007.001a1.39 1.39 0 0 0 1.013-1.605l.001.009l-.392-2.822a6.66 6.66 0 0 0 4.808 2.044q.065.002.128-.006l.093-.005l-.669 3.902a.41.41 0 0 1-.4.339H9.96l.327 1.547h14.157a1.221 1.221 0 0 1 .002 2.44H23.28v.091a1.9 1.9 0 1 1-3.802 0zm1.358 0a.539.539 0 1 0 1.07-.094v.003h-1.06a1 1 0 0 0-.008.091zm-9.528 0a.539.539 0 1 0 1.07-.094v.003h-1.061l-.007.089v.002zm3.867-13.875a1.39 1.39 0 0 0-1.013 1.605l-.001-.009l.719 5.19c.044.333.196.625.418.845c.202.201.479.327.786.33h.001q.102 0 .199-.019l-.007.001a1.39 1.39 0 0 0 1.013-1.605l.001.009l-.719-5.19a1.45 1.45 0 0 0-.418-.845a1.13 1.13 0 0 0-.786-.331h-.001q-.104 0-.201.02l.007-.001zm-3.966 0a1.387 1.387 0 0 0-1.014 1.609l-.001-.009l.719 5.19c.044.333.196.625.418.845c.202.201.479.327.786.33h.001q.102 0 .199-.019l-.007.001a1.39 1.39 0 0 0 1.014-1.605l.001.009l-.72-5.193a1.45 1.45 0 0 0-.418-.845a1.13 1.13 0 0 0-.786-.331H11.4q-.102 0-.198.019zm8.789-1.128a5.678 5.678 0 1 1 11.36.002a5.678 5.678 0 0 1-11.362-.003zm1.627 0a4.051 4.051 0 1 0 8.106 0a4.051 4.051 0 0 0-8.108-.001zm3.24 1.621v-.808h-.808a.814.814 0 0 1 0-1.628h.808v-.808a.814.814 0 0 1 1.628 0v.808h.808a.814.814 0 0 1 0 1.628h-.808v.807a.814.814 0 0 1-1.628 0z" />
          </svg> 
            </button>
</div>
  <button @click="ajouterproduct(product)"
    class="bg-[#4C6444] text-white px-4 py-2 rounded hover:bg-[#3c5238] transition">
    Ajouter au panier
  </button>

  <!-- Label ajoute avec succès -->
<LabelajoutPanier
 v-if="showLabelajoutPanier"
 :user="user"
 @labelajoutPanier-closed="closeLabelajoutPanier"
 />


    </div>
  </div>
</template>

<script setup>
import RecommandationSection from '@/Components/RecommandationSection.vue';
import LabelajoutPanier from '@/Components/LabelajoutPanier.vue';
import { usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
  product: {
    type: Object,
    required: true,
  },
})

const showLabelajoutPanier = ref(false);

const user = usePage().props.auth.user;

function ajouterproduct(product) {
  if (!user){
    alert('Veuillez vous connecter pour ajouter au panier');
    router.get('/login')
    return;
  }
  
  console.log('Sending request to add product:', product.id);
  
  router.post('/cart/add', {
    product_id: product.id,
    quantity: 1, 
  }, {
    onSuccess: () => {
      showLabelajoutPanier.value = true;
      // alert('Produit ajouté au panier avec succès!')
    },
    onError: (errors) => {
      console.error('Erreurs reçues du serveur :', errors);
      console.error('Status:', errors.status);
      console.error('Response:', errors.response);
      
      if (errors.status === 419) {
        alert('Session expirée ou problème de sécurité. Veuillez actualiser la page et réessayer.');
      } else if (errors.status === 401) {
        alert('Vous devez être connecté pour ajouter au panier.');
        router.get('/login');
      } else {
        alert('Erreur lors de l\'ajout au panier: ' + (errors.message || 'Erreur inconnue'));
      }
    }
  });
}

function onLabelajoutPanierClosed() {
  showLabelajoutPanier.value = false;
}

function goToPanier() {
  if (user) {
    router.get('/panier');
  } else {
    alert('Veuillez vous connecter pour voir votre panier');
    router.get('/login');
  }
}

function handleImageError(event) {
  console.error('Image failed to load:', event.target.src);
  event.target.src = '/img/PRD1.jpg'; // fallback image
}
</script>
