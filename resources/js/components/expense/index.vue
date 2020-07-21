<template>
    <div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item"><router-link to="home">Home</router-link></li>
                <li class="breadcrumb-item active" aria-current="page"><router-link to="expenses">Expenses</router-link></li>
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
                                        <th> Expense Details </th>
                                        <th> Amount </th>
                                        <th> Expense Date </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="expense in filterSearch" :key="expense.id">
                                        <td>{{ expense.details}}</td>
                                        <td>{{ expense.amount}}</td>
                                        <td>{{ expense.expense_date}}</td>

                                        <td>
                                            <router-link :to="{ name:'edit-expense', params:{id: expense.id} }" class="btn btn-sm btn-primary" >Edit</router-link>
                                            <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger" >Delete</a>
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
        name: "index",
        created() {
            if (!User.loggedIn()){
                this.$router.push('/')
            }
        },
        data(){
            return{
                expenses:[],
                searchTerm:''

            }
        },
        computed:{
            filterSearch(){
                return  this.expenses.filter(expense => {
                    return  expense.expense_date.match(this.searchTerm)
                })
            }
        },
        methods:{
            allExpense(){
                axios.get('/api/expense/')
                    .then(({data}) => this.expenses = data)
                    .catch()
            },
            deleteExpense(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/expense/'+id)
                            .then(()=>{
                                this.expenses = this.expenses.filter(expense => {
                                    return expense.id != id
                                })
                            })
                            .catch(() => {
                                this.$router.push({name:'expense'})
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            }
        },
        mounted() {
            this.allExpense()
        }
    }
</script>

<style scoped>

</style>
