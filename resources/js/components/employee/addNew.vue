Ei part e amra dekhbo kivabe image soho amra akta form insert korte pari:

akta form image soho insert korte hole amader akta pakage install korte hobe :
pakage name: interventiontion.


First Step:
pakage install:
curl -sS https://getcomposer.org/installer | php
php composer.phar require intervention/image



Second Step:
After you have installed Intervention Image, open your Laravel config file config/app.php and add the following lines.
In the $providers array add the service providers for this package.




Intervention\Image\ImageServiceProvider::class

Add the facade of this package to the $aliases array.




'Image' => Intervention\Image\Facades\Image::class

Now the Image Class will be auto-loaded by Laravel.




Step Three:
Now publish intervention js
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"

step Four:






Code:

<template>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header  d-flex align-items-center justify-content-between mt-4 mb-0">
                    <h3 class="text-left font-weight-light my-4">Insert New Employee</h3>
                    <button class="btn btn-success">
                        <router-link to="/all-Employee" class="text-white">All Employee</router-link>
                    </button>
                </div>
                <div class="card-body">
                    <form @submit.prevent="employee" enctype="multipart/form-data">
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
                                    <input type="file" class="btn btn-info" @change="onSubmitChange" id="">
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
                            <button type='submit' class="btn btn-outline-primary btn-block">Create new Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>



<script>
    import notification from "../../helpers/notification";

    export default {
        name: "employee",
        created() {
            if (!User.loggedIn()) {
                this.$router.push({name: 'home'})
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
                    phone: null


                },
                errors: {}
            }
        },
        methods: {
            employee() {

            },
            onSubmitChange(event) {
                let file = event.target.files[0]

                if (file.size > 1048770) {
                    Notifications.success()
                } else {
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.photo = event.target.result

                        console.log(event.target.result)

                    }
                    reader.readAsDataURL(file);

                }


            },
            employeeInsert(){
                axios.post('/api/Employee')
                    .then(()=>{
                        this.$router.push({name:'Employee'})
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }

</script>

<style scoped>

</style>
