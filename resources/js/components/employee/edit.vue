
<template>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0 rounded-lg mt-5">
                <div class="card-header  d-flex align-items-center justify-content-between mt-4 mb-0">
                    <h3 class="text-left font-weight-light my-4">Update Employee</h3>

                </div>
                <div class="card-body" style="border: 1px solid antiquewhite;">
                    <form @submit.prevent="employeeUpdate" enctype="multipart/form-data">
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
                                    <label class="small mb-1" for="address">Address</label>
                                    <input class="form-control py-4" id="address" type="text" placeholder="Address" v-model="form.address"/>
                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="salary">Salary</label>
                                    <input class="form-control py-4" id="salary" type="text" aria-describedby="emailHelp" placeholder="Salary" v-model="form.salary"/>
                                    <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1">Joining Date</label>
                                    <input class="form-control py-4" id="joining_date" type="date"  v-model="form.joining_date"/>
                                    <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="phone">Phone Number</label>
                                    <input class="form-control py-4" id="phone" type="text" aria-describedby="emailHelp" placeholder="Phone Number" v-model="form.phone"/>
                                    <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                </div>
                            </div>
                        </div>



                        <div class="form-row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="nid">NID Number</label>
                                    <input class="form-control py-4" id="nid" type="text" aria-describedby="emailHelp" placeholder="NID Number" v-model="form.nid"/>
                                    <small class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- <div class="col-md-4"> -->
                                <div class="form-group">
                                    <label class="small mb-1">Insert Photo</label><br>
                                    <input type="file" class="btn btn-info" @change="onfileselected" id="">
                                    <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                                </div>
                                <!-- </div> -->
                            </div>

                            <div class="col-md-2">
                                <label class="small mb-1" for="nid">Selected Image</label><br>
                                <img :src="form.photo" style="height:40px;width:40px;" alt="">
                            </div>
                            <!-- </div> -->
                        </div>

                        <div class="form-group">
                            <button type='submit' class="btn btn-outline-primary btn-block">Update Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                form: {
                    name: null,
                    email: null,
                    address: null,
                    salary: null,
                    joining_date: null,
                    nid: null,
                    photo: null,
                    newPhoto:null,
                    phone: null

                },
                errors: {}
            }
        },
        created(){
            let id = this.$route.params.id
              axios.get('/api/employee/'+id)
                  .then(({data}) => (this.form = data))
                  .catch(console.log('Error'))
        },


        methods:{
            onfileselected(event){
                let file = event.target.files[0];

                if (file.size > 1048770){
                    Notifications.image_validation()
                }else {
                    let reader = new FileReader();
                    reader.onload = event =>{
                        this.form.newPhoto = event.target.result
                        console.log(event.target.result)
                    };
                    reader.readAsDataURL(file)

                }
            },
            employeeUpdate(){
                let id = this.$route.params.id
                axios.patch ('/api/employee/'+id,this.form)
                    .then(()=>{
                        this.$router.push({name: 'employee'})
                        Notifications.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }

    }

</script>

<style scoped>

</style>
