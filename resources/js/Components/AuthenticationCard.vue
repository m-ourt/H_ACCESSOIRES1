<template>
  <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white overflow-hidden">
    <!-- fond -->
    <div class="absolute inset-0 bg-[url('/img/bglogin.jpg')] bg-cover bg-center opacity-50 z-0"></div>

    <!-- Logo -->
    <div class="z-10">
      <slot name="logo" />
    </div>

    <!-- formulaire-->
    <div class="z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-[#4C6444] text-black shadow-md overflow-hidden sm:rounded-lg">
      <slot />
    </div>
  </div>
</template>


