<script>
export default{
    name:'LabelajoutPanier',
    props:{
        user:{
            type: Object,
            required: true
        },
        isNewUser:{
            type: Boolean,
            default: false
        }
    },
    data(){
        return {
            showLabelajoutPanier: true 
        }
    },
    computed:{
        userName(){
            if(this.user.prenom && this.user.nom){
                return this.user.prenom + ' ' + this.user.nom;
            }else if( this.user.prenom){
                return this.user.prenom;
            }else if(this.user.nom){
                return this.user.nom;
            }else{
                return 'Cher client';
            }
        },
        MessageajoutPanier(){
            if(this.isNewUser){
                return "Votre premier achat a été ajouté au panier"
            } else {
                return "Votre produit a été ajouté au panier"
            } 
        }
    },
    methods: {
        closeLabelajoutPanier(){
            this.showLabelajoutPanier = false
            this.$emit('labelajoutPanier-closed')
        }
    },
    mounted(){
        setTimeout(() => {
            if (this.showLabelajoutPanier){
                this.closeLabelajoutPanier()
            }
        }, 1000000)
    }
}
</script>

<style scoped>
.labelajoutPanier-overlay {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: auto;
    height: auto;
    background: transparent;
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    z-index: 1000;
    animation: slideInFromRight 0.3s ease-out;
}

.labelajoutPanier-modal {
    position: relative;
    background: #CABA9C;
    border-radius: 12px;
    padding: 1.5rem;
    max-width: 300px;
    width: auto;
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3);
    animation: slideInFromRight 0.3s ease-out;
    border: 2px solid #4D2A14;
}

/*.labelajoutPanier-label {
    position: absolute;
    bottom: 0.75rem;
    right: 1rem;
    font-size: 0.75rem;
    color: #4D2A14;
    background-color: #E8E0C9;
    padding: 4px 8px;
    border-radius: 4px;
    opacity: 0.85;
}*/


.labelajoutPanier-content {
    text-align: center;
}

.labelajoutPanier-icon{
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
}
.labelajoutPanier-title{
    font-size: 1.25rem;
    font-weight: 700;
    color:#4D2A14;
    margin-bottom: 0.5rem;
}

.labelajoutPanier-message{
    font-size: 0.875rem;
    color:#4D2A14;
    line-height: 1.4;
    margin-bottom: 1rem;
}

.labelajoutPanier-actions{
    display:flex;
    justify-content: center;
}

.btn-primary{
    background:linear-gradient(135deg, #4D2A14 50%, #4D2A14 100%);
    color: #ffffff;
    border:#6e2e06;
    padding:8px 20px;
    border-radius:6px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
} 

.btn-primary:hover{
    transform: translateY(-1px);
    box-shadow: 0 5px 15px -3px rgba(142, 82, 32, 0.4);
} 

.btn-primary:active{
    transform: translateY(0);
}

@keyframes slideInFromRight{
    from{
        opacity:0;
        transform: translateX(100%);
    }
    to{
        opacity:1;
        transform: translateX(0);
    }
}

@keyframes fadeIn{
    from{
        opacity:0;
    }
    to{
        opacity:1;
    }
}
        /*RESPONSIVE*/ 
        @media (max-width: 640px){
            .labelajoutPanier-overlay {
                bottom: 10px;
                right: 10px;
            }
            
            .labelajoutPanier-modal{
                padding: 1rem;
                max-width: 250px;
            }
            
            .labelajoutPanier-title{
                font-size: 1rem;
            }
            
            .labelajoutPanier-message{
                font-size: 0.75rem;
            }
            
            .btn-primary {
                padding: 6px 16px;
                font-size: 0.75rem;
            }
        }
</style>

<template>
    <div v-if="showLabelajoutPanier" class="labelajoutPanier-overlay" > 
        <div class="labelajoutPanier-modal">
            <div class="labelajoutPanier-content">
                <h2 class="labelajoutPanier-title">{{  isNewUser ? 'premier achat': 'produit ajouté' }} </h2>
                <p class="labelajoutPanier-message">{{ MessageajoutPanier }}</p>
                <div class="labelajoutPanier-actions">
                    <button @click="closeLabelajoutPanier" class="btn-primary">
                        {{ isNewUser ? 'OK' : 'OK' }}
                    </button>
                </div>
        </div>
        
    </div>
    </div>

</template>