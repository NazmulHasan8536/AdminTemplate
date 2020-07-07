<template>
    <div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" @submit.prevent='forget'>
						<div class="module-head">
							<h3>Forget Password</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="email" id="inputEmail" placeholder="Email Address" v-model="form.email">
								</div>
                                <small class="text-danger" v-if="errors.email" style="color:red;">{{errors.email[0]}}</small>
							</div>
						</div>

						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-success pull-right">forget password</button>

								</div>

                                <br>
                                <div class="controls clearfix">
									<router-link to="/" class="pull-left" >Already Have Account ?</router-link>
									<router-link to="/register" class="pull-right" >Need a Account ?</router-link>

								</div>


							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->
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
        forget(){

        }
    }

}
</script>
