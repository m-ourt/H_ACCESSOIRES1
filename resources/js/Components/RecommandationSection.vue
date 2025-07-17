<template>
  <div class="mt-6 px-4">
    <h2 class="text-xl font-semibold text-[#4C6444] mb-4">Recommandations pour vous</h2>

    <div class="flex overflow-x-auto gap-4 pb-4">
      <Link
        v-for="(item, index) in recommended"
        :key="index"
        :href="item.link"
        class="min-w-[200px] relative group cursor-pointer rounded-md overflow-hidden shadow-md"
      >
        <!-- Image -->
        <img
          :src="item.image"
          alt="Recommandation"
          class="w-full h-48 object-cover transition duration-300 group-hover:scale-105"
        />

        <!-- Titre -->
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white text-sm px-2 py-1">
          {{ item.title }}
        </div>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const recommended = [
  {
    title: "Top accessoire homme achetés",
    image: "/img/PRD (6).jpg",
    link: "/categorie/homme", // remplace plus tard avec ta vraie route
  },
  {
    title: "Top accessoires femme achetés",
    image: "/img/PRD (3).jpg",
    link: "/categorie/femme",
  },
  {
    title: "Top accessoires enfant achetés",
    image: "/img/PRD (7).jpg",
    link: "/categorie/enfant",
  },
  {
    title: "Top accessoires luxe achetés",
    image: "/img/PRD (9).jpg",
    link: "/categorie/luxe",
  },
];
</script>
