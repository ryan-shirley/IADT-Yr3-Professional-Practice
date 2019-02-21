<template>
    <div class="modal fade quick-view" id="quickViewProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img v-if="product.image.url" :src="'/storage/' + product.image.url" :title=" product.name " :alt=" product.name " class="card-img-top" />
                        </div>
                        <div class="col-md-7">
                            <div class="content mt-3 mr-4">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h2 class="mb-2 h3">{{ product.name }}</h2>
                                <p class="description">
                                    {{ product.description }}
                                </p>
                                <p class="price h4 pb-4">
                                    €{{ product.price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/.Row -->
                </div>
            </div>
            <!--/.Modal Content -->
        </div>
        <!--/.Modal Dialog -->
    </div>
    <!--/.Quick View modal -->
</template>

<script>
export default {
    data() {
        return {
            product: {
                name: '',
                description: '',
                price: '',
                image: {
                    url: ''
                }
            }
        }
    },
    mounted() {
        var app = this
        var id = app.$route.params.id

        $('#quickViewProduct').modal('show');

        $('#quickViewProduct').on('hidden.bs.modal', function (e) {
            console.log('Closed click out');
            app.$router.push({ name: 'about' })
        });


        axios.get('/api/product/' + id)
        .then(function (resp) {
            // handle success
            console.log(resp.data);
            app.product  = resp.data;
        })
        .catch(function (resp) {
            // handle error
            console.log(resp);
            alert('Could not load product');
        })
    }
}
</script>
