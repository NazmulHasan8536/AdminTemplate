<template>

</template>

<script>
export default {
    created(){
        User.logout()

         // Toaster
                    Toast.fire({
                        icon: 'success',
                        title: 'Logout successfully'
                     })

                    this.$router.push({name:'/'})
    }
}
</script>
