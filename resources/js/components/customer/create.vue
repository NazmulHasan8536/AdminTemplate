
<template>

    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="store-customer">Customer</router-link></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rounded-lg">
                    <div class="card-header  d-flex align-items-center justify-content-between mb-0">
                        <h3 class="text-left font-weight-light ">Insert New Customer</h3>
                        <button class="btn btn-success">
                            <router-link to="/customers" class="text-white">All Customer</router-link>
                        </button>
                    </div>
                    <div class="card-body" style="border: 1px solid antiquewhite;">
                        <form @submit.prevent="customerInsert" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="name">Full Name</label>
                                        <input class="form-control py-4" id="name" type="text" placeholder="Enter the name" v-model="form.name"/>
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
                                        <label class="small mb-1" for="phone">Phone Number</label>
                                        <input class="form-control py-4" id="phone" type="text" aria-describedby="emailHelp" placeholder="Phone Number" v-model="form.phone"/>
                                        <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                                    </div>
                                </div>

                            </div>


                            <div class="form-row">


                                <div class="col-md-12">
<!--                                    <div class="col-md-6">-->
                                        <!-- <div class="col-md-4"> -->
                                        <div class="form-group">
<!--                                            <div class="col-md-6">-->
                                                <label class="small mb-1">Insert Photo</label><br>
                                                <input type="file" class="btn btn-info" @change="onfileselected" id="">
                                                <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
<!--                                            </div>-->


<!--                                            <div class="col-md-6">-->
                                            <br>
                                                <label class="small mb-1" for="">Selected Image</label><br>
                                                <img :src="form.photo" style="height:80px;width: 20%;float: left;margin-top: 10px;margin-bottom: 10px;}" alt="">
<!--                                            </div>-->
                                        </div>
                                        <!-- </div> -->
<!--                                    </div>-->


                                </div>

                                <!-- </div> -->
                            </div>

                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">Create new Customer</button>
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
    name: "customer",
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
                photo: null,
                phone: null

            },
            errors: {}
        }
    },


    methods:{
        onfileselected(event){
            let file = event.target.files[0];

            if (file.size > 1048770){
                Notifications.image_validation()
            }else {
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file)

            }
        },
        customerInsert(){
            axios.post ('/api/customer/',this.form)
                .then(()=>{
                    this.$router.push({name: 'customers'})
                    Notifications.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        }
    }

}

</script>

<style scoped>

</style>
