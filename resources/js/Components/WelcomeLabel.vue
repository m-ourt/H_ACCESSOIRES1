<script>
export default{
    name:'WelcomeLabel',
    props:{
        user:{type: Object,
            required:true
        },
        isNewUser:{
            type: Boolean,
            default:false
        }
    },
    data(){
        return {
            showWelcome:true 
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
        welcomeMessage(){
            if(this.isNewUser){
                return "Votre espace est prêt - découvrez nos nouveautés et créez votre collection d'accessoires préférés."
            } else {
                return "Votre espace est prêt - découvrez nos nouveautés et complétez votre collection d'accessoires préférés."
            } 
        }
    },
    methods: {
        closeWelcome(){
            this.showWelcome = false
            this.$emit('welcome-closed')
        }
    },
    mounted(){
        setTimeout(() => {
            if (this.showWelcome){
                this.closeWelcome()
            }
        }, 10000)
    }
}
</script>

<style scoped>
.welcome-overlay {
    position: fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background: rgba (0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    animation: fadeIn 0.3s ease-out;
}
.welcome-modal {
    background: #CABA9C;
    border-radius:16px;
    padding: 2rem;
    max-width: 500px;
    width: 90%;
    box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);
    animation: slideIn 0.3s ease-out;
}
.welcome-content {
    text-align: center;
}

.welcome-icon{
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
}
.welcome-title{
    font-size:1.875rem;
    font-weight: 700;
    color:#4D2A14;
    margin-bottom: 1rem;

}
.welcome-message{
    font-size:1.125rem;
    color:#4D2A14;
    line-height: 1.6;
    margin-bottom: 2rem;
}
.welcome-actions{
    display:flex;
    justify-content: center;
}
.btn-primary{
    background:linear-gradient(135deg, #4D2A14 50%, #4D2A14 100%);
    color: #ffffff;
    border:#6e2e06;
    padding:12px 32px;
    border-radius:8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
} 
 .btn-primary:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(142, 82, 32, 0.4);
 } 
 .btn-primary:active{
    transform: translateY(0);
 }
 @keyframes fadeIn{
    from{
        opacity:0;
    }
    to{
        opacity:1;
    }
 }
    @keyframes slideIn{
        from{
            transform: translateY(-20px);
            opacity:0;
        }
        to{
            transform: translateY(0);
            opacity:1;
        }
    }
        @keyframes slideIn{
            from{
                opacity:0;
                transform: translateY(-20px) scale(0.95);
            }
            to{
                opacity: 1;
                transform:translateY(0) scale(1);
            }
        }
        /*RESPONSIVE*/ 
        @media (max-width: 640px){
            .welcome-modal{
                padding:1.5rem;
                margin:1rem;
            }
            .welcome-title{
                font-size: 1.5rem;
            }
            .welcome-message{
                font-size: 1rem;
            }
        }
</style>

<template>
    <div v-if="showWelcome" class="welcome-overlay" > 
        <div class="welcome-modal">
            <div class="welcome-content">
                <h2 class="welcome-title">{{  isNewUser ? 'bienvenue': 'Bon retour' }}, {{ userName }}! </h2>
                <p class="welcomeMessage">{{ welcomeMessage }}</p>
                <div class="welcome-actions">
                    <button @click="closeWelcome" class="btn-primary">
                        {{ isNewUser ? 'Commencer' : 'Continuer' }}
                    </button>
                </div>
        </div>
    </div>
    </div>

</template>