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
                    <h2 class="text-right p-2">point of sale</h2> <br>
                </div>
                <div class="row">
                   <div class="col-lg-5 col-md-5">
                       <div class="row card container">
                           <div class="card-header">
                               <i class="mdi mdi-account-box-multiple menu-icon"></i>
                               Products
                           </div>
                           <div class="card-body">

                           </div>
                       </div>
                   </div>

                    <div class="col-lg-7 col-md-7">
                        <div class="row card container">
                            <div class="card-header">
                                <i class="mdi mdi-account-box-multiple menu-icon"></i>
                                Products
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li>nav</li>
                                </ul>
                            </div>






<!--                            //categories...........-->
                            <form action="">

                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Product</a>

                                    </li>
                                    <li class="nav-item" v-for="category in categories" :key="category">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="subproduct(category.id)">{{ category.category_name}}</a>
                                    </li>


                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <input type="text" v-model="searchTerm" placeholder="search" class="form-control" > <br>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 col-6" v-for="product in filterSearch" :key="product">
                                                <a href="">
                                                    <div class="card" style="width: 9rem;height: 180px;">
                                                        <img :src="product.image" card="card-img-top" style="width:100px;height: 100px;" alt="">
                                                        <div class="card-body">
                                                            <small class="card-title">{{ product.product_name }}</small>
                                                            <span class="badge badge-success" v-if="product.product_quantity >= 1">Available ({{product.product_quantity}})</span>
                                                            <span class="badge badge-danger" v-else="">Stock Out</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" area-labelledby="pills-profile-tab">
                                        <input type="text" v-model>

                                    </div>
                                </div>


<!--                                end-->
                            </form>








                        </div>
                    </div>
                </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->

            <!-- partial -->
        </div>
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
    mounted(){
        this.allProducts();
        this.allCategory();
    },
    data() {
        return {
            products:[],
            categories:'',
            getproducts:[],
            searchTerm:'',
            getserchTerm:''
        }
    },
    computed:{
        filterSearch(){
            return  this.products.filter(product => {
                return  product.product_name.match(this.searchTerm)
            })
        },
        getfilterSearch(){
            return  this.getproducts.filter(getproduct => {
                return  getproduct.product_name.match(this.getsearchTerm)
            })
        },

    },
    methods:{
        allProducts(){
            axios.get('/api/product')
                .then(({data}) => this.products = data)
                .catch()
        },
        allCategory(){
            axios.get('/api/category/')
                .then(({data}) => this.categories = data)
                .catch()
        },
        subproduct(){
            axios.get('/api/getting/product/'+id)
                .then(({data}) => this.getproducts = data)
                .catch(error => this.error = error.response.data.error)
        },

    },





}

</script>

<style>
#em_photo{
    height: 100px;
    width: 90px;
}
</style>
