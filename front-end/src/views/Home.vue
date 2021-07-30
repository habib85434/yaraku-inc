<template>
  <div
    class="py-5"
  >
    <div class="container px-3" style="max-width: 65rem">
      <div class="form-outer-container mb-5">
        <form>
          <div class="container px-5" >
            <div class="row">
              <div class="col-md-5">
                <div class="d-flex align-items-baseline input-row">
                  <p for="title" class="form-label input-title"
                    >Title <span class="required-mark">*</span></p
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="title"
                  />
                </div>
              </div>
              <div class="col-md-5">
                <div class="d-flex align-items-baseline input-row auther-input-container">
                  <p for="auther" class="form-label input-title"
                    >Auther <span class="required-mark">*</span></p
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="auther"
                  />
                </div>
              </div>
              <div class="col-md-2">
                <div class="d-flex justify-content-end btn-container">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr />
        <div class="container d-flex justify-content-end mb-3 px-5">
          <button type="button" class="btn btn-primary me-3 py-1">CSV</button>
          <button type="button" class="btn btn-primary py-1">XML</button>
        </div>
        <form>
          <div class="container px-5">
            <div class="row">
              <div class="col-md-5">
                <div class="d-flex align-items-baseline input-row">
                  <p for="searchTitle" class="form-label input-title"
                    >Title</p
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="searchTitle"
                  />
                </div>
              </div>
              <div class="col-md-5">
                <div class="d-flex align-items-baseline input-row auther-input-container">
                  <p for="searchAuther" class="form-label input-title"
                    >Auther</p
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="searchAuther"
                  />
                </div>
              </div>
              <div class="col-md-2">
                <div class="d-flex justify-content-end btn-container">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="table-wrapper">
        <table class="table table-bordered pt-3">
          <thead>
            <tr>
              <th scope="col" style="min-width: 100px;">
                <div class="d-flex justify-content-between">
                  <label>Title</label>
                  <i class="fas fa-sort-up"></i>
                </div>
              </th>
              <th scope="col" style="width: 341px;">
                <div class="d-flex justify-content-between">
                  <label>Auther</label>
                  <i class="fas fa-sort-down"></i>
                </div>
              </th>
              <th scope="col" style="width: 78px;"><label>Delete</label></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><label> 1</label> </td>
              <td>
                <!-- <label class="editable-text">Mark</label> -->
                <div class="d-flex table-auther-column">
                  <input
                    type="text"
                    class="form-control"
                  />
                  <div class="d-flex justify-content-center edit-btns-container">
                    <button type="button" class="btn btn-primary py-1 me-3"><i class="fas fa-check"></i></button>
                    <button type="button" class="btn btn-danger py-1"><i class="fas fa-times"></i></button>
                  </div>
                </div>
 
              </td>
              <td>
                <button type="button" class="btn delete-button py-1">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><label>2</label> </td>
              <td><label class="editable-text">Jacob</label></td>
              <td>
                <button type="button" class="btn delete-button py-1">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
//import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "Home",
  components: {},
};
</script>
<style scoped>
label {
  font-size: 0.95rem;
}
th, td {
  padding: 10px;
  border: 1px solid #CCCCCC;
}
table {
  border-style: hidden;
  margin: 0px
}
.table-wrapper {
  overflow: auto;
  border-radius: 6px;
  border: 1px solid #dee2e6;
}
.editable-text {
  border-bottom: dashed 1px #428bca;
}
.editable-text:hover {
  cursor: text;
}
.form-control {
  padding:0.15rem .75rem;
}
.form-outer-container {
  background: #f5f5f5;
  padding: 7vh 2vw;
  border-radius: 10px;
  border: thin solid #dee2e6;
}
.btn-container {
  height:100%;
}
.btn {
  padding: 0rem .5rem;
  font-size: 0.95rem;
}
.delete-button:hover {
    color: #fff;
    border-color: #6c757d;
}
.delete-button {
  background-image: linear-gradient(white, #b3b6b9);
  border-color: #b3b6b9;
  /* padding-top: 0.2rem;
  padding-bottom: 0.2rem; */
}
.input-title {
  /* padding: 0 2rem 0 0; */
  font-size: 0.95rem;
  width: 8rem;
  white-space: nowrap;
}
.required-mark {
  color: red;
}
.edit-btns-container {
  padding:0 0 0 10px;
}
@media (min-width: 768px) {
  .auther-input-container {
    padding-left:20px
  }
}
@media (max-width: 767.98px) { 
  .input-row {
    padding-bottom: 3vh;
  }
  .form-outer-container {
    padding: 7vh 4vw;
  }
 }
@media (max-width: 575.98px) {    
  .input-row {
      flex-direction: column;
    }
  .table-auther-column {
    flex-direction: column;
  }
  .edit-btns-container {
    padding:10px 0 0 0;
  }
}
</style>
