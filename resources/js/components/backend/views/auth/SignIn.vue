<template>
  <div class="app">
    <div
      class="container-fluid p-h-0 p-v-20 bg full-height d-flex"
      style="background-image: url('/backend/assets/images/others/login-3.png')"
    >
      <div class="d-flex flex-column justify-content-between w-100">
        <div class="container d-flex h-100">
          <div class="row align-items-center w-100">
            <div class="col-md-7 col-lg-5 m-h-auto">
              <div class="card shadow-lg">
                <div class="card-body">
                  <div
                    class="
                      d-flex
                      align-items-center
                      justify-content-between
                      m-b-30
                    "
                  >
                    <img
                      class="img-fluid"
                      alt=""
                      :src="image_url + '/backend/assets/images/logo/logo.png'"
                    />
                    <h2 class="m-b-0">Sign In</h2>
                  </div>
                  <form @submit.prevent="signIn">
                    <div class="form-group">
                      <label class="font-weight-semibold" for="email"
                        >Email:</label
                      >
                      <div class="input-affix">
                        <i class="prefix-icon anticon anticon-user"></i>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="email"
                          v-model="signInForm.email"
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="font-weight-semibold" for="password"
                        >Password:</label
                      >
                      <a class="float-right font-size-13 text-muted" href=""
                        >Forget Password?</a
                      >
                      <div class="input-affix m-b-10">
                        <i class="prefix-icon anticon anticon-lock"></i>
                        <input
                          type="password"
                          class="form-control"
                          id="password"
                          placeholder="Password"
                          v-model="signInForm.password"
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <div
                        class="
                          d-flex
                          align-items-center
                          justify-content-between
                        "
                      >
                        <span class="font-size-13 text-muted">
                          Don't have an account?
                          <a class="small" href=""> Signup</a>
                        </span>
                        <button type="submit" class="btn btn-primary">
                          Sign In
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-none d-md-flex p-h-40 justify-content-between">
          <span class="">© 2022 Quadque</span>
          <ul class="list-inline">
            <li class="list-inline-item">
              <a class="text-dark text-link" href="">Legal</a>
            </li>
            <li class="list-inline-item">
              <a class="text-dark text-link" href="">Privacy</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive } from "@vue/reactivity";
import { useStore } from "vuex";
import { inject } from "@vue/runtime-core";
export default {
  setup() {
    let signInForm = reactive({});
    let store = useStore();
    let base_url = inject("base_url");
    let image_url = inject("image_url");

    function signIn() {
      store
        .dispatch("signIn", signInForm)
        .then(() => {
          //   this.$router.push({name:"Home"})
        })
        .catch((error) => {
          if (error.response.status == 404) {
            this.errorMsg = error.response.data.message[0];
          } else if (error.response.status == 401) {
            this.errorMsg = error.response.data.message[0];
          } else if (error.response.status == 422) {
            $.each(error.response.data.errors, function (item, index) {
              let input = jQuery(document).find('input[name="' + item + '"]');
              let inputAfter = jQuery(document).find(
                'input[name="' + item + '"] + span'
              );

              input.addClass("is-invalid");

              inputAfter.remove();
              // input.after('<span class="text-danger">'+error.response.data.errors[item]+'</span>')
            });
          } else {
          }
        });
    }

    return {
      signInForm,
      store,
      signIn,
      base_url,
      image_url,
    };
  },
};
</script>