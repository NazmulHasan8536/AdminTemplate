
<template>

    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="store-category">Category</router-link></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0 rounded-lg">
                    <div class="card-header  d-flex align-items-center justify-content-between mb-0">
                        <h3 class="text-left font-weight-light ">Insert New Category</h3>
                        <button class="btn btn-success">
                            <router-link to="/expense" class="text-white">All Expense</router-link>
                        </button>
                    </div>
                    <div class="card-body" style="border: 1px solid antiquewhite;">
                        <form @submit.prevent="expenseInsert" >
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1">Expense Details</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Details Here" rows="3" v-model="form.details"></textarea>
                                        <small class="text-danger" v-if="errors.details">{{errors.details[0]}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1">Amount</label>
                                        <input class="form-control py-4" id="cat_id" type="text" placeholder="Enter Category name" v-model="form.amount"/>
                                        <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                                    </div>
                                </div>

                            </div>



                            <div class="form-group">
                                <button type='submit' class="btn btn-outline-primary btn-block">Create Expenses</button>
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
        created() {
            if (!User.loggedIn()){
                this.$router.push('/')
            }
        },
        data(){
            return{
                form:{
                    details:null,
                    amount:null,
                },
                errors:''
            }
        },
        methods:{
            expenseInsert(){
                axios.post ('/api/expense/',this.form)
                    .then(()=>{
                        this.$router.push({name: 'expense'})
                        Notifications.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
