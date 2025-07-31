<template>
  <div class="espace-client">
    <!-- Composant Welcome Label -->
    <WelcomeLabel 
      v-if="showWelcome"
      :user="user"
      :is-new-user="isNewUser"
      @welcome-closed="onWelcomeClosed"
    />
    
    <!-- Contenu principal de l'espace client -->
    <div class="espace-client-content">
      <header class="espace-client-header">
        <h1>Espace Client</h1>
        <p>Bienvenue dans votre espace personnel</p>
      </header>
      
      <div class="espace-client-grid">
        <!-- Vos sections de l'espace client -->
        <div class="espace-client-card">
          <h3>Mes commandes</h3>
          <p>Consultez vos achats récents</p>
        </div>
        
        <div class="espace-client-card">
          <h3>Mon panier</h3>
          <p>Articles en attente</p>
        </div>
        
        <div class="espace-client-card">
          <h3>Mes favoris</h3>
          <p>Vos accessoires préférés</p>
        </div>
        
        <div class="espace-client-card">
          <h3>Nouveautés</h3>
          <p>Découvrez nos derniers produits</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import WelcomeLabel from '@/Components/WelcomeLabel.vue'

// Props
const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  isNewUser: {
    type: Boolean,
    default: false
  }
})

// State
const showWelcome = ref(true)

// Methods
function onWelcomeClosed() {
  showWelcome.value = false
}
</script>

<style scoped>
.espace-client {
  min-height: 100vh;
  background: #f8fafc;
}

.espace-client-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

.espace-client-header {
  text-align: center;
  margin-bottom: 3rem;
}

.espace-client-header h1 {
  font-size: 2.5rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.espace-client-header p {
  font-size: 1.125rem;
  color: #6b7280;
}

.espace-client-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.espace-client-card {
  background: white;
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.espace-client-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.espace-client-card h3 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.espace-client-card p {
  color: #6b7280;
  font-size: 0.875rem;
}

@media (max-width: 768px) {
  .espace-client-content {
    padding: 1rem;
  }
  
  .espace-client-header h1 {
    font-size: 2rem;
  }
  
  .espace-client-grid {
    grid-template-columns: 1fr;
  }
}
</style>