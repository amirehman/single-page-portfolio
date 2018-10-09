@extends ('admin.app')


@section('content')




<section class="columns">

  <div class="column">

    <section class="hero welcome is-small admin-content-hero">
            <div class="container is-fluid is-marginless">
              <h1 class="title is-size-4">
                    Add New Brand 
                </h1>
        </div>
    </section>


    @include ('admin.layouts.errors')
    @include ('admin.layouts.messages')


    <form v-cloak v-if="!editing" class="" action="/manage/brands" @submit.prevent="addBrand" method="post">
    <div class="columns">
      <div class="column">
        <b-field>
              <b-input v-model="brand.name" name="name" autocomplete="off"></b-input>
        </b-field>

        <p v-if="errors.length">
            <ul>
              <li class="help is-danger" v-if="!brand.name" v-for="error in errors">@{{ error.name }}</li>
            </ul>
          </p>

      </div>
      <div class="column">
        <button type="submit" :disabled="!brand.name" class="button is-link" name="button">Add</button>
      </div>
    </div>
  </form>

  <form v-cloak v-if="editing" action="/manage/brands" @submit.prevent="updateBrand" method="post">
  <div class="columns">
    <div class="column">
      <b-field>
            <b-input v-model="brand.name" name="name" autocomplete="off"></b-input>
      </b-field>


    <p v-if="errors.length">
          <ul>
            <li class="help is-danger" v-if="!brand.name" v-for="error in errors">@{{ error.name }}</li>
          </ul>
    </p>

    </div>
    <div class="column">
      <button type="submit" :disabled="!brand.name" class="button is-link" name="button">Update</button>
      <a class="button"  @click="cancelEdit" name="button">Cancel</a>
    </div>
  </div>
  </form>

    <div class="column">

      @component('admin/components/loader')@endcomponent

      <table v-cloak class="table is-fullwidth">
        <thead v-if="brands.length">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!brands.length">
              <td>There arn't any Brands please add some.</td>
          </tr>
          <tr v-for="(brand, key) in brands">
            <td>@{{ ++key }}</td>
            <td>@{{ brand.name }}</td>
            <td> <button class="has-text-info is-small button has-text-weight-semibold" @click="editBrand(key,brand.id,brand.name)" name="button">Edit</button> </td>
            <td> <button class="has-text-danger is-small button has-text-weight-semibold" @click="confirm(key,brand.id)" name="button">Delete</button> </td>
          </tr>
        </tbody>
      </table>

    </div>



</div>

</section>



<!-- <table class="table is-fullwidth">
  <thead>
    <tr>
      <th>Hello</th>
      <th>Khan</th>
    </tr>
  </thead>
</table> -->

@endsection

@section('scripts')
<script>
  var app = new Vue({
    el: '#app',
    data() {
  
      return {
        loading: false,
        editing: false,
        brandid: "",
        brands: {},
        brand: {
          name: ''
        },
        errors: []
  
  
      }
    },
  
    methods: {
      confirm(key, id) {
        this.$dialog.confirm({
          message: 'Are you sure?',
          onConfirm: () => this.deleteBrand(key, id)
        });
      },
  
      addBrand() {
  
        axios.post(`/manage/brands`, {
            name: this.brand.name
          })
          .then(response => {
            this.getBrands()
            this.$toast.open({
              duration: 800,
              message: `Brand Added Successfully`,
              type: 'is-success'
            });
          })
  
        this.brand.name = ""
  
      },
      deleteBrand(key, id) {
        axios.delete(`/manage/brands/${id}`)
          .then((response) => {
            this.brands.splice(key - 1, 1);
            this.$toast.open({
              duration: 2000,
              message: `Brand Delete Successfully`,
              type: 'is-success'
            });
          })
      },
      editBrand(key, id, name) {
        this.editing = true
        this.brand.name = name;
        this.brandid = id;
      },
      cancelEdit() {
        this.editing = false
        this.brand.name = "";
        this.brandid = "";
      },
      updateBrand() {
  
        let id = this.brandid;
        axios.put(`/manage/brands/${id}`, {
            name: this.brand.name
          })
          .then(response => {
            this.getBrands()
            this.$toast.open({
              duration: 2000,
              message: `Brand Updated Successfully`,
              type: 'is-success'
            });
          })
        this.editing = false
        this.brand.name = "";
        this.brandid = "";
  
      },
      getBrands() {
        axios.get('/api/brands').then(response => {
          this.brands = response.data.brands
        });
      }
    },
    mounted() {
  
      this.loading = true;
      this.getBrands();
      this.loading = false;
    }
  });
</script>
@endsection
