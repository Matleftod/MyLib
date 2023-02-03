<template>
    <div class="container-mybook">
      <div class="title">
        <h1>My Book</h1>
        <div class="list-book">
          <h3 v-if="isEmpty == true">No book found :/</h3>
          <div v-for="book in listBook">
            <div>
              <h3>Titre : {{book.title}} <br/> Auteur : {{book.author}}</h3>
              <a @click="deleteBook(book.id)">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
 </template>
  
<script lang="ts">
import { isProxy, toRaw } from 'vue';

  export default {
    name: 'Home',
    data() {
        return {
          currentUserId: null,
          listBook: [],
          isEmpty: false
        }
    },
    methods: {
      checkListBook(){
        console.log(toRaw(this.listBook))
        if(JSON.stringify(this.listBook).length == 0)
        {
          this.isEmpty = true
        }else{
          this.isEmpty = false
        }
      },

      updateBooks(){
        this.listBook = []
        fetch('/api/mybooks/get', {
          method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
          data.forEach(book => {
            if(book.userId === this.currentUserId)
              this.listBook.push(book)
          });
        })
      },

      deleteBook($bookId){
        console.log($bookId)
        fetch('/api/mybooks/delete/' + $bookId, {
          method: 'DELETE',
        }).then(response => response.json())
        .then(data => {
          console.log(data)
        })
        this.updateBooks()
        this.checkListBook()
      }
    },
    created(){ 
      fetch('/api/authenUser', {
        method: 'GET',
      })
      .then(response => response.json())
      .then(user => {
        this.currentUserId = user.id
      }),

      fetch('/api/mybooks/get', {
        method: 'GET',
      })
      .then(response => response.json())
      .then(data => {
        data.forEach(book => {
          if(book.userId === this.currentUserId)
            this.listBook.push(book)
        });
      })

      this.checkListBook()
    }
  }
  </script>
  
  <style scoped>
  .list-book{
    text-align: start;
  }

  .list-book h3{
    margin-bottom: 0;
  }
  .list-book a{
    cursor: pointer;
  }
  </style>
  