<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="salary">Salary </router-link></li>
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
                                        <th> Salary Month </th>
                                        <th> Details </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="salary in filterSearch" :key="salary.salary_month">
                                        <td> {{salary.salary_month}} </td>
                                        <td>
                                            <router-link :to="{ name:'view-salary', params:{id: salary.salary_month} }" class="btn btn-sm btn-primary" >Edit</router-link>
<!--                                            <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger" >Delete</a>-->
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
        name: "Salary",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                salaries:[],
                searchTerm:''
            }
        },
        computed:{
            filterSearch(){
                return  this.salaries.filter(salary => {
                    return  salary.salary_month.match(this.searchTerm)
                })
            }
        },
        methods:{
            allSalary(){
                axios.get('/api/salary')
                    .then(({data}) => this.salaries = data)
                    .catch()
            },
            deleteEmployee(id){
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
                        axios.delete('/api/employee/'+id)
                            .then(()=>{
                                this.employees = this.employees.filter(employee => {
                                    return employee.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name:'employee'})
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
            this.allSalary();
        },



    }

</script>

<style>
    #em_photo{
        height: 40px;
        width: 60px;
    }
</style>
