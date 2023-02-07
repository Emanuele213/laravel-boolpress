<template>
    <div>
        <header>
            <NavBar></NavBar>
        </header>
        <main class="container">
            <router-view></router-view>
        </main>

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
}
</script>

<style lang="scss">
    @import '~bootstrap/scss/bootstrap';
</style>
