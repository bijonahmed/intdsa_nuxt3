<template>
  <!-- navbar start  -->
  <div class="container-fluid " style="position: sticky; top: 0; left: 0; z-index: 9; width: 100%;">
    <div class="row">
      <div class="col-md-12 col-sm-12 px-0">
        <nav class="navbar navbar-expand-lg bg-body-transparent">
          <div class="container">
            <nuxt-link class="navbar-brand p-2" to="/"><img src="/assets/images/LOGO_1.png" class="img-fluid"
                alt=""></nuxt-link>

            <div class="offcanvas-lg offcanvas-end " style="background-color: #ffffff; color: #fff;width: 100%;"
              tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasResponsiveLabel"><img src="/assets/images/LOGO_1.png"
                    style="max-height: 40px;" alt=""></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                  data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav ms-xl-auto mb-2 mb-lg-0">

                  <li class="nav-item">
                    <nuxt-link class="nav-link active" aria-current="page" to="/about"><i
                        class="fa-regular fa-star"></i>About </nuxt-link>
                  </li>

                  <li class="nav-item" v-if="email">
                    <nuxt-link class="nav-link active" aria-current="page" to="/partner/dashboard"><i
                        class="fa-solid fa-file-lines"></i>Dashboard</nuxt-link>
                  </li>
                </ul>

                <ul class=" store_buttons  m-0 ms-auto" style="list-style: none; padding: 0;">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#CompayProfiloe"><img
                        src="/assets/images/apps(1).png" class="img-fluid" loading="lazy" alt=""> </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#CompayProfiloe"><img
                        src="/assets/images/apps(2).png" class="img-fluid" loading="lazy" alt=""> </a>
                  </li>
                </ul>

                <ul class="navbar-nav  mb-2 mb-lg-0 second_ul_none" v-if="!email">
                  <li class="nav-item">
                    <nuxt-link class="nav-link btn-login" aria-current="page" to="/sign-in">Log In</nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link class="btn btn_trial" aria-current="page" to="/sign-up">Sign up</nuxt-link>
                  </li>
                </ul>
                <ul class="navbar-nav  mb-2 mb-lg-0 second_ul_none" v-if="email">
                  <li class="nav-item">
                    <nuxt-link class="nav-link btn-login" aria-current="page" to="#" @click="logout">Logout</nuxt-link>
                  </li>

                </ul>

              </div>
              <div class="offcanvas-footer second_ul_hide">
                <ul class=" store_buttons_m m-auto text-center">
                  <div class="">
                    <ul class="d-flex justify-content-center p-0 m-0 my-1 align-items-center">
                      <li>
                        <a href="#"><img src="/assets/images/apps(1).png" alt="" class="img-fluid px-2 mx-auto"></a>
                      </li>
                      <li>
                        <a href="#"><img src="/assets/images/apps(2).png" alt="" class="img-fluid px-2 mx-auto"></a>
                      </li>
                    </ul>
                  </div>
                  <li class="nav-item" v-if="!email">
                    <nuxt-link class="nav-link btn-login" aria-current="page" to="/sign-in">Log In</nuxt-link>
                  </li>
                  <li class="nav-item">
                    <nuxt-link class="btn btn_trial" aria-current="page" to="/sign-up">Sign up</nuxt-link>
                  </li>
                </ul>
 
              </div>
            </div>

            <div class="d-flex align-items-center">
              <ul class="mobile_support m-0 p-0" style="list-style: none;">
                <li>
                  <a class="nav-link active me-2" aria-current="page" href="https://tawk.to/chat/6623d635a0c6737bd12e88f2/1hrtvpgh0" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                      <path
                        d="M480-100.782q-22.087 0-37.544-15.456-15.457-15.457-15.457-37.544 0-22.088 15.457-37.544 15.457-15.457 37.544-15.457l276.043.565v-285.13q0-111.913-81.217-188.043-81.217-76.13-194.826-76.13t-194.826 76.13q-81.217 76.13-81.217 188.043l2.826 210.218q.565 22.087-15.174 37.826-15.739 15.739-37.827 15.739h-2.826q-37.522 0-63.848-26.043-26.326-26.044-26.326-63.566v-89.609q0-21.565 9.934-40.348 9.935-18.782 27.805-31.478l.739-28.129q3.478-74.783 35.26-139.001 31.783-64.218 83.24-111.74 51.456-47.522 119.174-74.63Q404.652-859.218 480-859.218t142.849 27.109q67.5 27.108 119.174 74.413 51.674 47.305 83.239 111.805 31.566 64.5 35.478 139.283l.739 27.129q18.435 11.261 28.087 30.392 9.652 19.13 9.652 40.261v93.696q0 23.391-8.804 45.065t-28.935 33.5v30.347q0 43.74-30.848 74.588-30.848 30.848-74.588 30.848H480ZM366.783-385.304q-18.131 0-30.478-12.347-12.348-12.348-12.348-29.914 0-17.565 12.348-29.913 12.347-12.348 30.478-12.348 18.13 0 30.478 12.348 12.348 12.348 12.348 29.913 0 17.566-12.348 29.914-12.348 12.347-30.478 12.347Zm226.434 0q-18.13 0-30.478-12.347-12.348-12.348-12.348-29.914 0-17.565 12.348-29.913 12.348-12.348 30.478-12.348 18.131 0 30.478 12.348 12.348 12.348 12.348 29.913 0 17.566-12.348 29.914-12.347 12.347-30.478 12.347ZM239.87-477.262Q234-578.174 306.413-647.674q72.413-69.5 175.587-69.5 90.13 0 158.761 54.239 68.63 54.239 77.543 141.109-85.913-1-161.282-40.804-75.37-39.804-117.5-114.456-18.826 73.782-72.87 126.108-54.043 52.326-126.782 73.716Z" />
                    </svg>
                  </a>
                </li>
              </ul>

 
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                <span class=""> <i class="fa-solid fa-bars"></i></span>
              </button>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- navbar end  -->
</template>

<script>
import { useUserStore } from '~~/stores/user';
import { storeToRefs } from 'pinia';

export default {
  setup() {
    const userStore = useUserStore();
    const { email } = storeToRefs(userStore);

    const logout = async () => {
      const router = useUserStore(); // Get the router object
      try {

        await userStore.logout();
        localStorage.removeItem('token');
        router.push('/'); // Redirect to the root route
        return;

      } catch (error) {
        console.error(error);
      }

    };

    return { email, logout };
  },
};
</script>

<style>
.navFixed {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
}
</style>