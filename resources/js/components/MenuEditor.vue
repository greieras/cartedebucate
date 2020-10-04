<template>
    <div class="container">
        <h3>Menu editor</h3>
        <nav>
            <router-link :to="{name: 'categories'}">Categories</router-link>
            <router-link :to="{name: 'add-item'}">Add Item</router-link>
            <router-link :to="{name: 'items'}">Items</router-link>
            <router-view></router-view>
        </nav>
    </div>
</template>

<script>

import VueRouter from 'vue-router'
import MenuItem from './MenuItem.vue'
import CategoryManager  from './CategoryManager.vue';
import MenuItemList from './MenuItemList.vue';
import store from '../store';

export default {
    name: "MenuEditor",
    store,
    props: ['categories'],
    created() {
        this.$store.commit('SET_CATEGORIES', _.cloneDeep(this.categories));
    },
    router: new VueRouter({
        mode: 'history',
        base: 'menu-editor',
        routes: [
            {
                path: '/categories',
                name: 'categories',
                component: CategoryManager
            },
            {
                path: '/items',
                name: 'items',
                component: MenuItemList
            },
            {
                path: '/',
                redirect: {name: 'categories'},
            },
            {
                path: '/add-item',
                name: 'add-item',
                component: MenuItem
            },
            {
                path: '/edit-item/:id',
                name: 'edit-item',
                component: MenuItem,
                props: true
            },
            {
                path: '/items',
                name: 'menu-item-list',
                component: MenuItemList
            },
            {
                path: '*',
                redirect: '/'
            }
        ]
    })
}
</script>

<style scoped>
    a {
        border: 1px solid black;
        padding: 7px;
        margin: 0;
    }

    .router-link .active {
        font-weight: bold;
        border-bottom: none;
        margin-top: 50px;
    }
</style>
