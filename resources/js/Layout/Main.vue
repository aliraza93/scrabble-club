<template>
    <div>
      <!-- Header -->
      <header class="bg-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <h1 class="text-white text-2xl font-bold">Scrabble Club</h1>
        </div>
      </header>
  
      <!-- Top Navbar -->
      <nav class="bg-gray-900 shadow">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
          <div class="flex items-center justify-between h-16">
            <!-- Navigation Links -->
            <div class="hidden md:block">
              <div class="flex items-center space-x-4">
                <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="/members" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Members</a>
              </div>
            </div>
  
            <!-- Hamburger Menu for mobile -->
            <div class="-mr-2 flex md:hidden">
              <button @click="isOpen = !isOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
  
        <!-- Mobile Navigation Menu -->
        <div x-show="isOpen" @click.away="isOpen = false" class="md:hidden">
          <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="/members" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Members</a>
          </div>
        </div>
      </nav>
  
      <!-- Page Content -->
      <slot></slot>
    </div>
  </template>
  
  <script>
import { ref } from 'vue';

export default {
  setup() {
    const isOpen = ref(false);

    return { isOpen };
  }
};
</script>

  