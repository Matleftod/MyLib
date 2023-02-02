<template>
    <div class="book-list">
      <BookItem v-for="book in books" :key="book.id" :book="book"/>
    </div>
  </template>
  
  <script lang="ts">
  import BookItem from "./BookItem.vue";
  
  export default {
    name: 'BookList',
    props: {
      books: {
        type: Array,
        required: true
      }
    },
    components: {
      BookItem
    }
  };
  </script>
  
<style scoped>
.book-list{
    width: 90%;
    margin: 0 auto;
    margin-top: 25px;
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(170px,0.5fr));
    grid-gap: 20px;
    box-sizing: border-box;
}
  </style>
  