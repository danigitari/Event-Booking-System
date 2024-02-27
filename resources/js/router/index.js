import { createRouter, createWebHistory } from "vue-router";
import Login from "../Pages/Login.vue";
import AdminLogin from "../Pages/Admin/Login.vue";
import Register from "../Pages/Register.vue";
// import Dashboard from "../../components/admin/Dashboard.vue";
// import Sidebar from "../../components/Sidebar.vue";
// import Credentials from "../../components/admin/Credentials.vue";
// import Departments from "../../components/admin/Departments.vue";
// import Users from "../../components/admin/Users.vue";
// import UserSidebar from "../../components/user/UserSidebar.vue";


const routes = [
    {
        path: "/",
        name: "login",
        component: Login,
    },
    {
        path: "/admin/login",
        name: "admin-login",
        component: AdminLogin,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },

    

];
const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach((to, from, next) => { 
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!localStorage.getItem('token')) {
            next('/')
        } 
        else {
            next()
        }
    } 
    else {
        next()
    }

    // if (to.matched.some(record => record.meta.isAdmin)) {
    //     if (localStorage.getItem('role') != 'admin') {
    //         next('/user-sidebar')
    //     } 
    //     else {
    //         next()
    //     }
    // }
 
})

export default router;
