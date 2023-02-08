<template>
 <div>
    <h1>Index dei post</h1>
    <div v-if="results">
        <div class="row g-3">
            <div v-for="post in results.data" :key="post.id" class="col-sm-6 col-md-4">
                <div class="card h-100">
                    <img :src="post.image" class="card-img-top" :alt="post.title">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-uppercase">{{ post.title }}</h5>
                        <p class="card-text flex-grow-1">{{ post.excerpt }}</p>
                        <router-link :to="{name: 'postsShow', params: {slug: post.slug}}" class="btn btn-primary">Leggi</router-link>
                    </div>
                </div>
            </div>

            <nav class="mt-4 d-flex justify-content-center">
                <ul class="pagination">
                    <li
                        class="page-item"
                        :class="{disabled: results.current_page == 1}"
                        @click.prevent="changePage(results.current_page - 1)"
                    >
                        <a class="page-link cursore">Previous</a>
                    </li>

                    <li
                        v-for="page in results.last_page"
                        :key="page"
                        class="page-item"
                        :class="{active: results.current_page == page}"
                    >
                        <a @click.prevent="changePage(page)" class="page-link cursore" >{{ page }}</a>
                    </li>


                    <li
                        class="page-item"
                        :class="{disabled: results.current_page == results.last_page}"
                    >
                        <a @click.prevent="changePage(results.current_page + 1)" class="page-link cursore">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div v-else class="loader_container">
        <div class="spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            results: null,
        }
    },
    methods: {
        changePage(page) {
            this.isLoading= true,
            axios.get('/api/posts?page=' + page)
                .then(response => {
                    this.results = response.data.results;
                    scrollTo(0,0); //porta sopra
                });
        }
    },
    created() {
        setTimeout(() => {
            this.changePage(1);
        }, 1.4 * 1000);
    }
}
</script>

<style lang="scss" scoped>
    .cursore {
        cursor: pointer;
    }

    .displayNone{
        display: none;
    }

    a {
        text-decoration: none;
    }
    .loader_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }

    .spinner {
   width: 44.8px;
   height: 44.8px;
   animation: spinner-y0fdc1 2s infinite ease;
   transform-style: preserve-3d;
    }

    .spinner > div {
    background-color: rgba(71,78,255,0.2);
    height: 100%;
    position: absolute;
    width: 100%;
    border: 2.2px solid #474eff;
    }

    .spinner div:nth-of-type(1) {
    transform: translateZ(-22.4px) rotateY(180deg);
    }

    .spinner div:nth-of-type(2) {
    transform: rotateY(-270deg) translateX(50%);
    transform-origin: top right;
    }

    .spinner div:nth-of-type(3) {
    transform: rotateY(270deg) translateX(-50%);
    transform-origin: center left;
    }

    .spinner div:nth-of-type(4) {
    transform: rotateX(90deg) translateY(-50%);
    transform-origin: top center;
    }

    .spinner div:nth-of-type(5) {
    transform: rotateX(-90deg) translateY(50%);
    transform-origin: bottom center;
    }

    .spinner div:nth-of-type(6) {
    transform: translateZ(22.4px);
    }

    @keyframes spinner-y0fdc1 {
    0% {
        transform: rotate(45deg) rotateX(-25deg) rotateY(25deg);
    }

    50% {
        transform: rotate(45deg) rotateX(-385deg) rotateY(25deg);
    }

    100% {
        transform: rotate(45deg) rotateX(-385deg) rotateY(385deg);
    }
    }
</style>
