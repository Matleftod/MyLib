<template>
    <div class="main-container">    
        <h1>Search a book</h1>
        <div class="query">
        <form @submit.prevent="search">
            <div>
            <input type="text" v-model="keyword" placeholder="Search..." class="input" required>
            <input type="submit" value="Search" class="button">
            </div>
            <div>
            <label for="order">Order by</label>&nbsp;
            <select name="order" v-model="orderBy" @change="search">
                <option value="newest">newest</option>
                <option value="relevance">relevance</option>
            </select>
            </div>
        </form>
        </div>
        <div class="content">
        <div class="loading" v-if="loadState == 'loading'"></div>
        <BookList v-if="loadState == 'success'" :books="books"/>
        </div>
        <div class="pagination" v-if="totalItems > 40">
            <div>
                <a href="#" v-for="(item, index) in Math.floor(totalItems/40)" :key="item" @click="updateIndex(index)">
                    {{ index + 1}}
                </a>
            </div>
        </div>
    </div>
</template>
  
<script lang="ts">
    import BookList from './BookList.vue'

    import axios from 'axios';

export default {
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
            `https://www.googleapis.com/books/v1/volumes?q=intitle:${
                this.keyword
            }&orderBy=${this.orderBy}&maxResults=${this.maxResults}&startIndex=${this.startIndex}&key=AIzaSyB_z_BFlcVvfkFQtRGhm4-wABK60LGAT78`
            )
            .then(response => {
            //console.log(response.data.items)
            this.books = response.data.items
            this.totalItems = response.data.totalItems
            this.loadState = 'success'
            })
        },
        updateIndex(index: number) {
            let counter = index * 40
            this.startIndex = counter.toString()
            console.log(counter.toString())
            this.search()
        }
    },
    name: 'Books',
    components: {
        BookList
    }
}
</script>

<style scoped>
.main-container{
    width: 100%;
}
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
</style>
  