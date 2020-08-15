
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
                        <form @submit.prevent="customerUpdate" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <label class="small mb-1">Insert Photo</label><br>
                                        <input type="file" class="btn btn-info" @change="onfileselected" id="">
                                        <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                                        <br>
                                        <label class="small mb-1" for="">Selected Image</label><br>
                                        <img :src="form.photo" style="height:80px;width: 20%;float: left;margin-top: 10px;margin-bottom: 10px;}" alt="">
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">
                                    Update Customer
                                </button>
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
                phone: null,
                newPhoto:null

            },
            errors: {}
        }
    },
    mounted(){
        let id = this.$route.params.id
        axios.get('/api/customer/'+id)
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
        customerUpdate(){
            let id = this.$route.params.id;
            axios.patch ('/api/customer/'+id,this.form)
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
