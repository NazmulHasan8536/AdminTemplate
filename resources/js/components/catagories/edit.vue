
<template>

    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="categories">Category</router-link></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rounded-lg">
                    <div class="card-header  d-flex align-items-center justify-content-between mb-0">
                        <h3 class="text-left font-weight-light ">Insert New Category</h3>
                        <button class="btn btn-success">
                            <router-link to="/categories" class="text-white">All Category</router-link>
                        </button>
                    </div>
                    <div class="card-body" style="border: 1px solid antiquewhite;">
                        <form @submit.prevent="UpdateCategory" >
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1">Category Name</label>
                                        <input class="form-control py-4" id="cat_id" type="text" placeholder="Enter Category name" v-model="form.category_name"/>
                                        <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>
                                    </div>
                                </div>

                            </div>



                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">Update Category</button>
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
        created() {
            if (!User.loggedIn()){
                this.$router.push('/')
            }
        },
        data(){
            return{
                form:{
                    category_name:null
                },
                errors:''
            }
        },
        created(){
            let id = this.$route.params.id

            axios.get('/api/category/'+id)
                .then(({data})=> this.form = data)
                .catch(console.log('error'))
        },
        methods:{
            UpdateCategory(){
                let id = this.$route.params.id
                axios.patch ('/api/category/'+id,this.form)
                    .then(()=>{
                        this.$router.push({name: 'categories'})
                        Notifications.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },


        }
    }
</script>
