<template>
    <div>
        <header>
            <NavBar></NavBar>
        </header>
        <main class="container">
            <h1>Sono App</h1>
            <router-view></router-view>
        </main>
        <!-- <div class="container">
            <h1>Frontoffice in Vue</h1>
            <div class="row g-3">
                <div v-for="post in arrPosts" :key="post.id" class="col-sm-6 col-md-4">
                    <div class="card h-100">
                        <img :src="post.image" class="card-img-top" :alt="post.title">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ post.title }}</h5>
                            <p class="card-text flex-grow-1">{{ post.excerpt }}</p>
                            <a :href="'/posts/' + post.slug" class="btn btn-primary">Leggi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <footer>
            <footer-componet></footer-componet>
        </footer>
    </div>
</template>

<script>
import NavBar from './components/NavBar.vue';
import FooterComponet from './components/FooterComponet.vue'

export default {
  name: 'App',
  components: {
    NavBar,
    FooterComponet,
  },
  data() {
    return {
        arrPosts: [],
    };
  },
  created() {
    axios.get('/api/posts')
      .then(response => this.arrPosts = response.data.results);
  }
}
</script>

<style lang="scss">
    @import '~bootstrap/scss/bootstrap';
</style>
