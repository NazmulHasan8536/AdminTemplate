<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="suppliers">supplier</router-link></li>
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
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Photo </th>
                                        <th> Phone </th>
                                        <th> Address </th>
                                        <th> Shop name </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="supplier in filterSearch" :key="supplier.id">
                                            <td>{{ supplier.name}}</td>
                                            <td>{{ supplier.email}}</td>
                                            <td>
                                                <img :src="supplier.photo" id="em_photo" alt="">
                                            </td>
                                            <td>{{ supplier.phone}}</td>
                                            <td>{{ supplier.address}}</td>
                                            <td>{{ supplier.shopname}}</td>
                                            <td>
                                                <router-link :to="{ name:'edit-supplier', params:{id: supplier.id} }" class="btn btn-sm btn-primary" >Edit</router-link>
                                                <a @click="deletesupplier(supplier.id)" class="btn btn-sm btn-danger" >Delete</a>

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
        name: "supplier",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                suppliers:[],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return  this.suppliers.filter(supplier => {
                    return  supplier.phone.match(this.searchTerm)
                })
            }
        },
        methods:{
            allsupplier(){
                axios.get('/api/supplier')
                    .then(({data}) => this.suppliers = data)
                    .catch()
            },
            deletesupplier(id){
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
                        axios.delete('/api/supplier/'+id)
                            .then(()=>{
                                this.suppliers = this.suppliers.filter(supplier => {
                                    return supplier.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name:'suppliers'})
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
            this.allsupplier();
        },



    }

</script>

<style>
    #em_photo{
        height: 40px;
        width: 60px;
    }
</style>
