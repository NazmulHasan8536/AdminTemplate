
<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="">Edit Products</router-link></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rounded-lg mt-5">
                    <div class="card-header  d-flex align-items-center justify-content-between mt-4 mb-0">
                        <h3 class="text-left font-weight-light my-4">Update Stock</h3>

                    </div>
                    <div class="card-body" style="border: 1px solid antiquewhite;">
                        <form @submit.prevent="updateStock">



                            <div class="form-row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1" for="product_quantity">Product Quantity</label>
                                        <input class="form-control py-4" id="product_quantity" type="text" aria-describedby="emailHelp" placeholder="Product Quantity" v-model="form.product_quantity"/>
                                        <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity[0]}}</small>
                                    </div>
                                </div>


                                <!-- </div> -->
                            </div>

                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>



<script>

    export default {
        name: "stck",
        mounted() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                form: {

                    product_quantity: null,


                },
                errors: {},
            }
        },
        created(){
            let id = this.$route.params.id
            axios.get('/api/product/'+id)
                .then(({data}) => (this.form = data))
                .catch()
        },


        methods:{
            updateStock(){
                let id = this.$route.params.id
                axios.post ('/api/stock/update/'+id,this.form)
                    .then(()=>{
                        this.$router.push({name: 'stocks'})
                        Notifications.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }

    }

</script>

<style scoped>

</style>
