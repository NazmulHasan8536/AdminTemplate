<template>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
               <h2 class="text-right p-2">Search</h2> <br>
                <input type="text" class="form-control" v-model="searchTerm" placeholder="Search here">
            </div>
            <div class="row">
                <div class="col-lg-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Table with contextual classes</h4>
                            <p class="card-description table-danger"> Add class <code>.table-{color}</code>
                            </p>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th> #id </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Photo </th>
                                    <th> Phone </th>
                                    <th> Address </th>
                                    <th> Salary </th>
                                    <th> Joining Data </th>
                                    <th> Status </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="employee in filterSearch" :key="employee.id">
                                    <td> {{ employee.id}} </td>
                                    <td> {{employee.name}} </td>
                                    <td> {{employee.email}} </td>
                                    <td><img :src="employee.photo" id="em_photo" alt=""></td>
                                    <td> {{employee.phone}} </td>
                                    <td> {{employee.address}} </td>
                                    <td> {{employee.salary}} </td>
                                    <td> {{employee.joining_date}} </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-primary" >Edit</a>
                                        <a href="" class="btn btn-sm btn-danger" >Delete</a>
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
                 return  employee.name.match(this.searchTerm)
              })
          }
        },
        methods:{
            allEmployee(){
                axios.get('/api/employee')
                    .then(({data}) => this.employees = data)
                    .catch()
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
