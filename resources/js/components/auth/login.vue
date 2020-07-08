
<template>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-6 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                </div>
                <h6 class="font-weight-light">Login Here</h6>
                <form class="pt-3" @submit.prevent='login'>



                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg backColor" id="exampleInputEmail1" placeholder="Email" v-model="form.email">
                      <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg backColor" id="exampleInputUsername1" placeholder="Password" v-model="form.password">
                      <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                  </div>
                  <!-- <div class="mb-4"> -->
                  <div class="mt-3">
                     <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN In</button>
                   </div>
                  <div class="text-center mt-4 font-weight-light text-white"> Need a Account ? <router-link to="/register" class="text-primary">Register</router-link>
                  </div>


                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
</template>



<script>
export default {
    created(){
        if(User.loggedIn()){
            this.$router.push({name:'home'})
        }
    },
    data(){
        return{
            form:{
                email:null,
                password:null
            },
              errors:{},
        }

    },
    methods:{
         login(){

                axios.post('/api/auth/login',this.form)
                .then(res =>{
                    User.ResponseTokenLogin(res)
                    // Toaster
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                     })

                    this.$router.push({name:'home'})

                })
                .catch(error => this.errors = error.response.data.errors)

            }
    }
}
</script>

<style>

</style>


