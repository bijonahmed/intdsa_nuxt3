<template>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li v-for="(menuItem, index) in menuItems" :key="index"
            :class="{ 'nav-item': true, 'menu-open': menuItem.children }">
            <router-link :to="menuItem.route ? menuItem.route : '#'" class="nav-link">
              <i :class="'nav-icon fas ' + menuItem.icon"></i>
              <p>
                {{ menuItem.label }}
                <i v-if="menuItem.children" class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            <ul v-if="menuItem.children" class="nav nav-treeview">
              <li v-for="(childItem, childIndex) in menuItem.children" :key="childIndex" class="nav-item">
                <router-link :to="childItem.route" class="nav-link">
                  <p>{{ childItem.label }}</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>


      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const menuItems = ref([
  {
    label: 'Dashboard',
    icon: 'fa-home',
    badge: 'New',
    open: false,
    route: '/admin/dashboard',
    children: null
  },
  {
    label: 'Profile',
    icon: 'fa-th',
    badge: 'New',
    open: false,
    route: '/user/my-profile',
    children: null
  },
  {
    label: 'User Management',
    icon: 'nav-icon fas fa-users',
    badge: '6',
    open: false,
    route: null,
    children: [
      { label: 'Incentive activities', icon: 'fa-circle', route: '/usermanagement/incentive-activities' },
      { label: 'Super Admin list', icon: 'fa-circle', route: '/usermanagement/superadmin-list' }, 
      { label: 'Admin list', icon: 'fa-circle', route: '/usermanagement/admin-list' }, 
      { label: 'Agent list', icon: 'fa-circle', route: '/usermanagement/agent-list' }, 
      { label: 'User list', icon: 'fa-circle', route: '/usermanagement/userlist' }, 
      { label: 'Order management', icon: 'fa-circle', route: '/usermanagement/order-management' },
      // { label: 'Manual dispatch', icon: 'fa-circle', route: '#'},
    ]
  },
  {
		label: 'Post Management',
		icon: 'fa-folder',
		badge: '',
		open: false,
		route: null,
		children: [
			{ label: 'Add Post', icon: 'fa-circle', route: '/post/add' },
			{ label: 'Post List', icon: 'fa-circle', route: '/post/list' },

		]
	},

  //new menu
  {
    label: 'System settings',
    icon: 'nav-icon fas fa-cog',
    badge: '6',
    open: false,
    route: null,
    children: [
      // { label: 'Pre-Setting', icon: 'fa-circle', route: '/setting/presetting' },
      { label: 'Sliders', icon: 'fa-circle', route: '/slider/list' },
      // { label: 'System Configaration', icon: 'fa-circle', route: '#' },
      // { label: 'Store Information', icon: 'fa-circle', route: '#' }
    ]
  },

  // {
  //   label: 'Site Configaration',
  //   icon: 'nav-icon fas fa-sliders-h',
  //   badge: '6',
  //   open: false,
  //   route: null,
  //   children: [
  //     { label: 'Site settings', icon: 'fa-circle', route: '/siteConfigaration/siteSettings' },
  //     { label: 'SMS settings', icon: 'fa-circle', route: '#' },
  //     { label: 'SEO settings', icon: 'fa-circle', route: '#' },
  //     { label: 'Protocal Management', icon: 'fa-circle', route: '#' }


  //   ]
  // },

  // {
  //   label: 'Permission Control',
  //   icon: 'nav-icon fas fa-user',
  //   badge: '6',
  //   open: false,
  //   route: null,
  //   children: [
  //    { label: 'Admin List', icon: 'fa-circle', route: '/permissionControl/adminList' },
  //     { label: 'Role Management', icon: 'fa-circle', route: '/permissionControl/roleManagement' },
  //     { label: 'Permission Assignment', icon: 'fa-circle', route: '#' },
  //   ]
  // },

  // {
  //   label: 'Website management',
  //   icon: 'nav-icon fas fa-user',
  //   badge: '6',
  //   open: false,
  //   route: null,
  //   children: [
  //     { label: 'Multi Langual management', icon: 'fa-circle', route: '#' },
  //     { label: 'National area code management', icon: 'fa-circle', route: '#' },
  //     { label: 'Popup announcement', icon: 'fa-circle', route: '#' },
  //     { label: 'Home Page Carousel', icon: 'fa-circle', route: '#' },
  //     { label: 'Payment Methods', icon: 'fa-circle', route: '#' },
  //   ]
  // },

  // {
  //   label: 'Fund management',
  //   icon: 'nav-icon fas fa-cog',
  //   badge: '6',
  //   open: false,
  //   route: null,
  //   children: [
  //     { label: 'Fund Products', icon: 'fa-circle', route: '#' },
  //     { label: 'Fund Orders', icon: 'fa-circle', route: '#' },
  //   ]
  // },

  {
    label: 'Product management',
    icon: 'nav-icon fas fa-cog',
    badge: '6',
    open: false,
    route: null,
    children: [
      { label: 'Categories', icon: 'fa-circle', route: '/productmanagement/categorylist' },
      { label: 'Products Management', icon: 'fa-circle', route: '/productmanagement/productlist' },
     
    ]
  },
  
  // {
  //   label: 'Article Management',
  //   icon: 'nav-icon fas fa-cog',
  //   badge: '6',
  //   open: false,
  //   route: null,
  //   children: [
  //     { label: 'Community Center', icon: 'fa-circle', route: '#' },
  //     { label: 'Artcle management', icon: 'fa-circle', route: '#' },
  //     { label: 'Artcle Classifications', icon: 'fa-circle', route: '#' },
  //   ]
  // },

  {
    label: 'Wallet Management',
    icon: 'nav-icon fas fa-cog',
    badge: '6',
    open: false,
    route: null,
    children: [
      // { label: 'Recipient bank management', icon: 'fa-circle', route: '/walletmanagement/recipientbank' },
      { label: 'Wallet', icon: 'fa-circle', route: '/walletmanagement/wallet' }, 
      { label: 'Manual adjustment remarks', icon: 'fa-circle', route: '/walletmanagement/manual-adjustment' },
      { label: 'User wallet', icon: 'fa-circle', route: '/walletmanagement/user-wallet'},
      { label: 'Deposit management ', icon: 'fa-circle', route: '/walletmanagement/deposit-management' },
      { label: 'Withdrawal management', icon: 'fa-circle', route: '/walletmanagement/withdrawal-management' },
      { label: 'Account details ', icon: 'fa-circle', route: '/walletmanagement/account-details' },
    ]
  },


  
 
  // {
  //   label: 'Data Management',
  //   icon: 'nav-icon fas fa-database',
  //   badge: '6',
  //   open: false,
  //   route: null,
  //   children: [
  //     { label: 'Dispatch report', icon: 'fa-circle', route: '#' },
  //     { label: 'Background operation log', icon: 'fa-circle', route: '#' }, 
  //     { label: 'Operational report', icon: 'fa-circle', route: '/datamanagement/operational-report' },
  //     { label: 'Withdrawal report', icon: 'fa-circle', route: '/datamanagement/withdrawal-report'},
  //     { label: 'Recharge report', icon: 'fa-circle', route: '/datamanagement/recharge-report'},
  //     { label: 'Message management', icon: 'fa-circle', route: '#'},

  //   ]
  // },

  
]);

const toggleMenu = (item) => {
  item.open = !item.open;
};
</script>
<style>
body:not(.layout-fixed) .main-sidebar {
  min-height: 100vh;
  position: fixed;
}
</style>