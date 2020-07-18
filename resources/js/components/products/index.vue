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
                                        <th> Product Code </th>
                                        <th> Category name </th>
                                        <th> Supplier Name </th>
                                        <th> Photo </th>
                                        <th> Godawon </th>
                                        <th> Buying Price </th>
                                        <th> Selling Price </th>
                                        <th> Product Quantity </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in filterSearch" :key="product.id">
                                        <td> {{product.product_name}} </td>
                                        <td> {{product.product_code}} </td>
                                        <td> {{product.category_id}} </td>
                                        <td> {{product.supplier_id}} </td>
                                        <td><img :src="product.image" alt="" id="em_photo"> </td>
                                        <td> {{product.root}} </td>
                                        <td> {{product.buying_price}} </td>
                                        <td> {{product.selling_price}} </td>
                                        <td> {{product.product_quantity}} </td>

                                        <td>
                                            <router-link :to="{ name:'edit-product', params:{id: product.id} }" class="btn btn-sm btn-primary" >Edit</router-link>
                                            <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger" >Delete</a>
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
            deleteProduct(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/product/'+id)
                            .then(()=>{
                                this.products = this.products.filter(product => {
                                    return product.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name:'products'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            }
        },

        mounted() {
            this.allProducts();
        },



    }

</script>

<style>
    #em_photo{
        height: 40px;
        width: 60px;
    }
</style>
