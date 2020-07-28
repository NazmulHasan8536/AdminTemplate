<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="/give-salary">salary</router-link></li>
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
                                        <th> Salary </th>
                                        <th> Date </th>
                                        <th> Month </th>
                                        <th> Year </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="salary in filterSearch" :key="salary.salary_given">
                                        <td> {{ salary.name}}</td>
                                        <td> {{ salary.email}}</td>
                                        <td> {{ salary.salary}}</td>
                                        <td> {{salary.salary_date}} </td>
                                        <td> {{salary.salary_month}} </td>
                                        <td> {{salary.salary_year}} </td>
                                        <td> <router-link :to="{ name:'edit-salary', params:{id: salary.salary_given} }" class="btn btn-sm btn-primary" >Edit Salary</router-link>

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
        name: "salary",
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
                    return  salary.name.match(this.searchTerm)
                })
            }
        },
        methods:{
            viewSalary(){
                let id = this.$route.params.id
                axios.get ('/api/salary/view/'+id)
                    .then(({data}) => this.salaries = data)
                    .catch(error => this.errors = error.response.data.errors)
            },
        },

        mounted() {
            this.viewSalary();
        },



    }

</script>

<style>
    #em_photo{
        height: 40px;
        width: 60px;
    }
</style>
