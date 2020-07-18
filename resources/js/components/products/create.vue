
<template>

    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="store-product">Products</router-link></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rounded-lg">
                    <div class="card-header  d-flex align-items-center justify-content-between mb-0">
                        <h3 class="text-left font-weight-light ">Insert New Product</h3>
                        <button class="btn btn-success">
                            <router-link to="/products" class="text-white">All Products</router-link>
                        </button>
                    </div>
                    <div class="card-body" style="border: 1px solid antiquewhite;">
                        <form @submit.prevent="productInsert" enctype="multipart/form-data">
                            <div class="form-row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Product Name</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Product Name" v-model="form.product_name"/>
                                        <small class="text-danger" v-if="errors.product_name">{{errors.product_name[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="product_code">Product Code</label>
                                        <input class="form-control py-4" id="product_code" type="text" placeholder="Product Code" v-model="form.product_code"/>
                                        <small class="text-danger" v-if="errors.product_code">{{errors.product_code[0]}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="">Category</label>
                                        <select class="browser-default custom-select custom-select-lg mb-3" v-model="form.category_id">
                                            <option  v-for="category in categories" :key="category.id">{{ category.category_name}}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.category_id">{{errors.category_id[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="">Supplier Id</label>
                                        <select class="browser-default custom-select custom-select-lg mb-3" v-model="form.supplier_id">
                                            <option v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name }}</option>>
                                        </select>
                                        <small class="text-danger" v-if="errors.supplier_id">{{errors.supplier_id[0]}}</small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1">buying_price</label>
                                        <input class="form-control py-4" id="buying_price" type="text"  v-model="form.buying_price" placeholder="Buying Price"/>
                                        <small class="text-danger" v-if="errors.buying_price">{{errors.buying_price[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="selling_price">Selling</label>
                                        <input class="form-control py-4" id="selling_price" type="text" aria-describedby="emailHelp" placeholder="Selling Price" v-model="form.selling_price"/>
                                        <small class="text-danger" v-if="errors.selling_price">{{errors.selling_price[0]}}</small>
                                    </div>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="">Root</label>
                                        <input class="form-control py-4" id="root" type="text" aria-describedby="emailHelp" placeholder="Godwan Name" v-model="form.root"/>
                                        <small class="text-danger" v-if="errors.root">{{errors.root[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="buying_date">Buying Date</label>
                                        <input class="form-control py-4" id="buying_date" type="date" aria-describedby="emailHelp" placeholder="Buying Date" v-model="form.buying_date"/>
                                        <small class="text-danger" v-if="errors.buying_date">{{errors.buying_date[0]}}</small>
                                    </div>
                                </div>
                            </div>





                            <div class="form-row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="product_quantity">Product Quantity</label>
                                        <input class="form-control py-4" id="product_quantity" type="text" aria-describedby="emailHelp" placeholder="Product Quantity" v-model="form.product_quantity"/>
                                        <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- <div class="col-md-4"> -->
                                    <div class="form-group">
                                        <label class="small mb-1">Insert Photo</label><br>
                                        <input type="file" class="btn btn-info" @change="onfileselected" id="">
                                        <small class="text-danger" v-if="errors.image">{{errors.image[0]}}</small>
                                    </div>
                                    <!-- </div> -->
                                </div>

                                <div class="col-md-2">
                                    <label class="small mb-1" for="">Selected Image</label><br>
                                    <img :src="form.image" style="height:40px;width:40px;" alt="">
                                </div>
                                <!-- </div> -->
                            </div>

                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">Create new Product</button>
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
        name: "products",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                form: {
                    product_name: null,
                    product_code: null,
                    category_id: null,
                    supplier_id: null,

                    buying_price: null,
                    selling_price: null,

                    root: null,
                    buying_date:null,

                    product_quantity: null,
                    image: null,

                },
                errors: {},
                suppliers:{},
                categories:{}
            }
        },


        methods:{
            onfileselected(event){
                let file = event.target.files[0];

                if (file.size > 1048770){
                    Notifications.image_validation()
                }else {
                    let reader = new FileReader();
                    reader.onload = event =>{
                        this.form.image = event.target.result
                        console.log(event.target.result)
                    };
                    reader.readAsDataURL(file)

                }
            },
            productInsert(){
                axios.post ('/api/product/',this.form)
                    .then(()=>{
                        this.$router.push({name: 'products'})
                        Notifications.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        },
        created() {
            axios.get('/api/category/')
                .then(({data}) => (this.categories = data))

            axios.get('/api/supplier/')
                .then(({data}) => (this.suppliers = data))


        }

    }

</script>

<style scoped>

</style>
