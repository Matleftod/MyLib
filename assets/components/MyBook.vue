<template>
    <div class="container-mybook">
      <div class="title">
        <h1>My Book</h1>
      </div>
      <BookList v-if="loadState == 'success'" :books="books"/>
    </div>
 </template>
  
<script lang="ts">
import BookList from './BookList.vue'

import axios from 'axios';

  export default {
    name: 'Home',
    data() {
        return {
            books: [],
            keyword: '',
            orderBy: 'newest',
            maxResults: '40',
            startIndex: '0',
            totalItems: 0,
            loadState: ''
        }
    },
    methods: {
        search() {
        this.loadState = 'loading'
        axios
            .get(
            `https://www.googleapis.com/books/v1/volumes/zyTCAlFPjgYC&key=AIzaSyB_z_BFlcVvfkFQtRGhm4-wABK60LGAT78`
            ).then(response => {
            //console.log(response.data.items)
            this.books = response.data.items
            this.loadState = 'success'
            })
        }
    },
    created(){
        
    }
  }
  </script>
  
  <style scoped>
  
  </style>
  