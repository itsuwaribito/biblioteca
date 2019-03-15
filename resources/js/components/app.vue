<template>
    <div >
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    props: {
        logged_user: {
            default() {
                return null
            }
        }
    },
    created() {
        var user = (this.logged_user.length != 0) ? this.logged_user: null
        localStorage.setItem('user', user)
    }
}    
</script>