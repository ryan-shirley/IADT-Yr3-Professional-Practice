<template>
    <div class="container-fluid full-width about">
        <div class="row no-gutters justify-content-md-center align-items-center">
            <div class="col-lg-6 col-md-8 image-full profile">
            </div>
            <div class="col-lg-6 text-center content">
                <h1 class="h2">About</h1>
                <hr />
                <p>
                    A multidisciplinary award winning designer with a focus on brand identity, digital, packaging and illustration. My approach is to create <strong>simple, functional identities</strong> that reflect the true character of the clients I work for.
                </p>

                <p>
                    As well as visual communications, I have a background in architecture. It wasn’t until the financial crash of 2008 that I was forced to re-evaluate my options and pursue the career that I am truly passionate about.
                </p>

                <small>Credit: <a href="http://johnrooneyillustration.com" target="_blank">Colm O'Connor</a></small>
            </div>
        </div>
        <div class="row no-gutters justify-content-md-center align-items-center">
            <div class="col-lg-6 order-2 order-lg-1 text-center content">
                <h2 class="h2">My Story</h2>
                <hr />
                <p>
                    She has worked with companies including Procreate, Simon & Schuster, Toltek Productions, and Playboy. She holds a BFA in Illustration with a minor in Animation, and graduated with Honors from California State University, Long Beach. 
                </p>

                <small>Credit: <a href="http://www.chelseablecha.com" target="_blank">Chelsea Blecha</a></small>
            </div>
            <div class="col-lg-6 col-md-8 order-1 order-lg-2 image-full heritage">

            </div>
        </div>

        <div class="container mt-5">
            <div class="row no-gutters">
                <div class="col-12">
                    <h3 class="text-center mb-5 mt-3">Latest Products</h3>
                </div>
                <div class="col-12">
                    <p v-if="products.length == 0">There are no products.</p>

                    <section v-if="products.length != 0" class="product-list">
                        <div class="row">
                            <div v-for="product in products" :key="product.id" class="col-lg-3 col-sm-6 product">
                                <router-link :to="{ name:'QuickViewProduct', params: { id:product.id }}"><img :src="'/storage/' + product.image.url" :title=" product.name " :alt=" product.name " class="card-img-top mb-3" /></router-link>
                                <h3><router-link :to="{ name:'QuickViewProduct', params: { id:product.id }}">{{ product.name }}</router-link></h3>
                                <p class="price">
                                    €{{ product.price }}
                                </p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        var app = this;
        axios.get('/api/products/latest')
        .then(function (resp) {
            // handle success
            console.log(resp.data);
            app.products = resp.data;

            console.log(app.products);
        })
        .catch(function (resp) {
            // handle error
            console.log(resp);
            alert('Could not load products');
        })
    },
    data() {
        return {
            products: []
        }
    }
}
</script>
