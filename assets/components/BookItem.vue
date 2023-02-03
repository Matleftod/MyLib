<template>
    <div class="book-item">
        <template v-if="volumeInfo.imageLinks">
          <img :src="volumeInfo.imageLinks.thumbnail" :alt="volumeInfo.title">
        </template>
        <template v-else>
          <img
            src="../assets/jsp.jpg"
            :alt="volumeInfo.title"
            width="128"
          >
        </template>
        <div class="bottom">
            <h4 class="title">{{ volumeInfo.title }}</h4>
    
            <p class="author">
                <span v-if="!volumeInfo.authors">No authors to display</span>
                <span v-else>
                    By
                    <span v-for="(author, index) in volumeInfo.authors" :key="index">
                    <em>
                        {{
                        index + 1 !== volumeInfo.authors.length && index + 1 !== book.volumeInfo.authors.length-1 ? author + ', ' : index + 1 == book.volumeInfo.authors.length && index+1 !== 1 ? ' and ' + author : author
                        }}
                    </em>
                    </span>
                </span>
            </p>
            <div>
              <a :href="volumeInfo.previewLink" target="_blank">See more | 
            </a>
            <a @click="addVolume">Add
            </a>
            </div>
        </div>
    </div>
  </template>
  
  <script lang="ts">

  export default {
    name: 'BookItem',
    data(){
      return{
        isError: false,
        errorMessage: '',
      }
    },
    props: {
      book: {
        type: Object,
        required: true
      }
    },
    computed: {
      volumeInfo(){
        return this.book.volumeInfo
      },
      addVolume(){
        fetch('/api/user_books', {
          method: 'POST',
          headers: {'Content-Type': 'application/ld+json'},
          body: JSON.stringify({
            "UserId": 28,
            "Title": this.book.volumeInfo.title,
            "Author": this.book.volumeInfo.authors[0],
            "userId": 28,
            "title": this.book.volumeInfo.title,
            "author": this.book.volumeInfo.authors[0]
          })
        })
        .then(response => response.json())
        .then(data => {
          console.log(this.book.volumeInfo.authors[0])
          console.log(data);
        })
      }
    }
  }
  </script>
  
  <style scoped>
  .book-item{
    text-align: center;
    background-color: rgb(31, 30, 30);
    border-radius: 1rem;
    padding: 10px;
    margin-bottom: 10px;
    box-shadow: 0 5px 5px black;
    transition: .5s;
    position: relative;
  }
  .book-item img{
    width: 100%;
    height: 200px;
    border-radius: 1rem 1rem 0 0;
  }

  .book-item .bottom {
    display: flex;
    flex-direction: column;
  }
  .book-item .bottom .author, .book-item .bottom .title {
    font-size: 14px;
    margin-bottom: 12px;
  }
  .book-item a{
    cursor: pointer;
  }
  ul {
    padding: 0;
  }
  
  ul li {
    display: inline-block;
  }
  
  ul li:first-child {
    list-style: none;
  }
  .author {
    font-size: 14px;
  }
</style>
  