<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="categories">Categories</router-link></li>
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
                                        <th> Id </th>
                                        <th> Category Name </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="category in filterSearch" :key="category.id">
                                        <td> {{category.id}} </td>
                                        <td> {{category.category_name}} </td>


                                        <td>
                                            <router-link :to="{ name:'edit-category', params:{id: category.id} }" class="btn btn-sm btn-primary" >Edit</router-link>
                                            <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger" >Delete</a>
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
        name: "index",
        created() {
            if (!User.loggedIn()){
                this.$router.push('/')
            }
        },
        data(){
            return{
                    categories:[],
                    searchTerm:''

            }
        },
        computed:{
            filterSearch(){
                return  this.categories.filter(category => {
                    return  category.category_name.match(this.searchTerm)
                })
            }
        },
        methods:{
            allCategories(){
                axios.get('/api/category/')
                    .then(({data}) => this.categories = data)
                    .catch()
            },
            deleteCategory(id){
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
                        axios.delete('/api/category/'+id)
                            .then(()=>{
                                this.categories = this.categories.filter(category => {
                                    return category.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name:'categories'})
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
            this.allCategories()
        }
    }
</script>

<style scoped>

</style>
