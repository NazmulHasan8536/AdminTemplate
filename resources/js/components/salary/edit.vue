
<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="">Edit Employee</router-link></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rounded-lg mt-5">
                    <div class="card-header  d-flex align-items-center justify-content-between mt-4 mb-0">
                        <h3 class="text-left font-weight-light my-4">Update Salary</h3>

                    </div>
                    <div class="card-body" style="border: 1px solid antiquewhite;">
                        <form @submit.prevent="salaryUpdate" >
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1">Full Name</label>
                                        <input class="form-control py-4" id="f_name" type="text" placeholder="Enter the name" v-model="form.name"/>
                                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email Address</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" v-model="form.email"/>
                                        <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" >Category</label>
                                        <select class="browser-default custom-select custom-select-lg mb-3" v-model="form.salary_month">
                                            <option value="January"  >January</option>
                                            <option  value="February">February</option>
                                            <option  value="march">march</option>
                                            <option  value="April">April</option>
                                            <option  value="June">June</option>
                                            <option  value="July">July</option>
                                            <option  value="August">August</option>
                                            <option  value="September">September</option>
                                            <option  value="October">October</option>
                                            <option  value="November">November</option>
                                            <option  value="December">December</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.category_id">{{errors.category_id[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="salary">Salary</label>
                                        <input class="form-control py-4" id="salary" type="text" aria-describedby="emailHelp" placeholder="Salary" v-model="form.amount"/>
                                        <small class="text-danger" v-if="errors.salary">{{errors.amount[0]}}</small>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" v-model="form.employee_id">



                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">Update Salary Salary</button>
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
        name: "employee",
        mounted() {
            if (!User.loggedIn()) {
                this.$router.push({name: '/'})
            }
        },
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    salary_month: null,
                    amount: null,
                    employee_id: null

                },
                errors: {}
            }
        },
        created(){
            let id = this.$route.params.id
            axios.get('/api/salary/edit/'+id)
                .then(({data}) => (this.form = data))
                .catch()
        },


        methods:{

            salaryUpdate(){
                let id = this.$route.params.id

                axios.post ('/api/salary/update/'+id,this.form)
                    .then(()=>{
                        this.$router.push({name: 'given-salary'})
                        Notifications.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }

    }

</script>

<style scoped>

</style>
