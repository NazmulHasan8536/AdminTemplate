<template>
    <div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
            <li class="breadcrumb-item active" aria-current="page"><router-link to="employees">Employee</router-link></li>
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
                                    <th> Nid </th>
                                    <th> Salary </th>
                                    <th> Joining Data </th>
                                    <th> Status </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="employee in filterSearch" :key="employee.id">
                                    <td> {{employee.name}} </td>
                                    <td> {{employee.email}} </td>
                                    <td><img :src="employee.photo" id="em_photo" alt=""></td>
                                    <td> {{employee.phone}} </td>
                                    <td> {{employee.address}} </td>
                                    <td> {{employee.nid}} </td>
                                    <td> {{employee.salary}} </td>
                                    <td> {{employee.joining_date}} </td>
                                    <td>
                                        <router-link :to="{ name:'edit-employee', params:{id: employee.id} }" class="btn btn-sm btn-primary" >Edit</router-link>
                                        <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger" >Delete</a>
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
        name: "employee",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                employees:[],
                searchTerm:''
            }
        },
        computed:{
          filterSearch(){
             return  this.employees.filter(employee => {
                 return  employee.phone.match(this.searchTerm)
              })
          }
        },
        methods:{
            allEmployee(){
                axios.get('/api/employee')
                    .then(({data}) => this.employees = data)
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
            this.allEmployee();
        },



    }

</script>

<style>
    #em_photo{
        height: 40px;
        width: 60px;
    }
</style>
