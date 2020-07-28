<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="products">Products</router-link></li>
            </ol>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h2 class="text-right p-2">Search</h2> <br>
                    <input type="text" class="form-control" v-model="searchTerm" placeholder="Search here">
                </div>
                <div class="row">
                    <div class="col-lg-12 stretch-card" style="margin-left: -75px;">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th> Product Name </th>
                                        <th> Photo </th>
                                        <th> Product Quantity </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in filterSearch" :key="product.id">
                                        <td> {{product.product_name}} </td>
                                        <td><img :src="product.image" alt="" id="em_photo"> </td>
                                        <td> {{product.product_quantity}} </td>
                                        <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Available</span></td>
                                        <td v-else=""><span class="badge badge-danger">Stock Out</span></td>

                                        <td>
                                            <router-link :to="{ name:'editStock', params:{id: product.id} }" class="btn btn-sm btn-primary" >Edit Stock</router-link>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->

            <!-- partial -->
        </div>
    </div>
    <!-- main-panel ends -->
</template>

<script>

    export default {
        name: "products",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                products:[],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return  this.products.filter(product => {
                    return  product.product_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allProducts(){
                axios.get('/api/product')
                    .then(({data}) => this.products = data)
                    .catch()
            },
        },

        mounted() {
            this.allProducts();
        },



    }

</script>

<style>
</style>
