<template>
  <div class="py-5">
    <div class="container px-3" style="max-width: 65rem">
      <div class="form-outer-container add-form-spacing">
        <form @submit.prevent="handleStoreSubmit(onSubmit)">
          <div class="container px-5">
            <div class="row">
              <div class="col-md-5">
                <div class="d-flex align-items-baseline input-row">
                  <p for="title" class="form-label input-title">
                    Title <span class="required-mark">*</span>
                  </p>
                  <input
                    v-model="storeForm.title"
                    type="text"
                    class="form-control"
                    id="title"
                  />
                </div>
              </div>
              <div class="col-md-5">
                <div
                  class="
                    d-flex
                    align-items-baseline
                    input-row
                    author-input-container
                  "
                >
                  <p for="author" class="form-label input-title">
                    Author <span class="required-mark">*</span>
                  </p>
                  <input
                    v-model="storeForm.author"
                    type="text"
                    class="form-control"
                    id="author"
                  />
                </div>
              </div>
              <div class="col-md-2">
                <div class="d-flex justify-content-end btn-container">
                  <button type="submit" class="btn btn-primary me-3 py-1">
                    Add
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div>
        <div class="row pt-2 pb-3">
          <div class="col-md-10 pt-3">
            <form @submit.prevent="handleSearchSubmit(onSubmit)">
              <div class="">
                <div class="row">
                  <div class="col-md-5">
                    <div class="d-flex align-items-baseline input-row">
                      <p for="searchTitle" class="form-label input-title">
                        Title
                      </p>
                      <input
                        type="text"
                        v-model="searchForm.data.title"
                        class="form-control"
                        id="searchTitle"
                      />
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div
                      class="
                        d-flex
                        align-items-baseline
                        input-row
                        author-input-container
                      "
                    >
                      <p for="searchAuthor" class="form-label input-title">
                        Author
                      </p>
                      <input
                        type="text"
                        v-model="searchForm.data.author"
                        class="form-control"
                        id="searchAuthor"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="d-flex justify-content-end btn-container">
                      <button type="submit" class="btn btn-primary me-3 py-1">
                        Search
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-2">
            <div
              class="d-flex justify-content-end align-items-end mb-3"
              style="height: 100%"
            >
              <!-- <p class="pe-2">Download:</p> -->
              <!-- Button trigger modal -->
              <button
                type="button"
                class="btn btn-primary me-3 py-1"
                title="Download CSV"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
                @click="openModal('csvModal')"
              >
                CSV
              </button>
              <button
                type="button"
                class="btn btn-primary py-1"
                title="Download XML"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
                @click="openModal('xmlModal')"
              >
                XML
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="table-wrapper">
        <table class="table table-bordered pt-3">
          <thead>
            <tr>
              <th class="ch-th-one" scope="col">
                <div class="d-flex justify-content-between">
                  <label>Title</label>
                  <div class="d-flex flex-column">
                    <i
                      @click="clickAscOrDesc('titleAsc')"
                      :class="`fas fa-sort-up sort-icon pt-2 px-2 mb-1 ${
                        titleAcsSort ? 'sort-highlight' : ''
                      }`"
                    ></i>
                    <i
                      @click="clickAscOrDesc('titleDesc')"
                      :class="`fas fa-sort-down sort-icon pb-2 px-2 ${
                        tilteDescSort ? 'sort-highlight' : ''
                      }`"
                    ></i>
                  </div>
                </div>
              </th>
              <th class="ch-th-tow" scope="col">
                <div class="d-flex justify-content-between">
                  <label>Author</label>
                  <div class="d-flex flex-column">
                    <i
                      @click="clickAscOrDesc('authorAsc')"
                      :class="`fas fa-sort-up sort-icon pt-2 px-2 mb-1 ${
                        authorAscSort ? 'sort-highlight' : ''
                      }`"
                    ></i>
                    <i
                      @click="clickAscOrDesc('authorDesc')"
                      :class="`fas fa-sort-down sort-icon pb-2 px-2 ${
                        authorDescSort ? 'sort-highlight' : ''
                      }`"
                    ></i>
                  </div>
                </div>
              </th>
              <th class="ch-th-three" scope="col">
                <label>Delete</label>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="book in bookList.data" :key="book.id">
              <td>
                <label>{{ book.title }}</label>
              </td>
              <td v-if="editOpen && editingBookID == book.id">
                <form
                  class="form-wrapper"
                  @submit.prevent="handleAuthorEditSubmit(onSubmit)"
                >
                  <div class="d-flex table-author-column">
                    <input
                      :value="book.author"
                      type="text"
                      class="form-control"
                      @input="updatedAuthorName"
                    />

                    <input ref="_id_" :value="book.id" type="hidden" />

                    <div
                      class="d-flex justify-content-center edit-btns-container"
                    >
                      <button type="submit" class="btn btn-primary py-1 me-3">
                        <i class="fas fa-check"></i>
                      </button>
                      <button
                        type="button"
                        @click="OpenOrCloseEdit()"
                        class="btn btn-danger py-1"
                      >
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </td>
              <td v-else>
                <label
                  @click="OpenOrCloseEdit(book.id)"
                  class="editable-text"
                  >{{ book.author }}</label
                >
              </td>
              <td>
                <button
                  type="button"
                  @click="showDeleteAlert(book.id)"
                  class="btn delete-button py-1"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <br />
      <div v-if="bookList && bookList.data && bookList.data.length">
        <pagination
          v-model="bookList.current_page"
          :records="bookList.total"
          :per-page="bookList.per_page"
          @paginate="paginate"
        />
      </div>
    </div>
  </div>

  <YIModal />
</template>

<script>
import YIModal from "@/components/business/yaraku-inc/yi-export-modal.vue";
import { mapActions } from "vuex";
import { mapGetters } from "vuex";
import { Form } from "vform";

export default {
  name: "Home",
  data() {
    return {
      search_mood: false,
      editOpen: false,
      editingBookID: null,
      titleAcsSort: true,
      tilteDescSort: false,
      authorAscSort: false,
      authorDescSort: false,
      queryStrings: {
        page: this.$route.query.page,
        record: this.$route.query.record,
        sort: this.$route.query.sort,
        order: this.$route.query.order,
      },
      editForm: new Form({
        author: "",
        id: null,
      }),

      searchForm: new Form({
        data: {
          author: null,
          title: null,
        },
        params: {},
      }),

      storeForm: new Form({
        author: null,
        title: null,
      }),
    };
  },
  components: { YIModal },
  computed: {
    ...mapGetters({
      bookList: "books/bookList",
    }),
  },
  mounted() {
    this.getBookList(this.queryStrings);
  },
  created() {
    this.initializeQueryParams();
    this.setQueryParams();
  },
  methods: {
    ...mapActions({
      getBookList: "books/getBookList",
      setExportTitle: "books/setExportTitle",
      deleteBook: "books/deleteBook",
      updateBookAuthor: "books/updateBookAuthor",
      searchBook: "books/searchBook",
      storeBook: "books/storeBook",
    }),
    initializeQueryParams() {
      if (this.$route.query.record == undefined && !this.$route.query.record)
        this.queryStrings.record = 15;

      if (this.$route.query.page == undefined && !this.$route.query.page)
        this.queryStrings.page = 1;

      if (this.$route.query.sort == undefined && !this.$route.query.sort)
        this.queryStrings.sort = "title";

      if (this.$route.query.order == undefined && !this.$route.query.order)
        this.queryStrings.order = "asc";
    },

    setQueryParams() {
      this.$router.push({
        path: this.$route.path,
        query: {
          record: this.queryStrings.record,
          page: this.queryStrings.page,
          sort: this.queryStrings.sort,
          order: this.queryStrings.order,
        },
      });
    },

    handleStoreSubmit() {
      alert("need to add validator");
    },

    handleSearchSubmit() {
      this.searchForm.params = this.queryStrings;
      this.searchBook(this.searchForm).then((res) => {
        if (res.data.success) {
          this.search_mood = true;
        }
      });
    },

    OpenOrCloseEdit(id) {
      this.editingBookID = id;
      if (this.editingBookID == id && this.editOpen == false) {
        this.editOpen = !this.editOpen;
      }
    },

    updatedAuthorName(data) {
      this.editForm.author = data.target.value;
    },

    handleAuthorEditSubmit() {
      this.editForm.id = this.$refs._id_.value;
      if (this.editForm.author != "") {
        this.updateBookAuthor(this.editForm).then((res) => {
          if (res.data.success) {
            this.$swal({
              title: "Success",
              text: "Author name updated successfully.",
              type: "success",
            });
            this.getBookList(this.queryStrings);
            this.editOpen = !this.editOpen;
          }
        });
      } else {
        this.$swal({
          title: "Warning!",
          text: "No changed found!",
          type: "warning",
        });
      }
    },

    showDeleteAlert(id) {
      this.$swal({
        title: "Delete this book?",
        text: "Are you sure? You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#084298",
        confirmButtonText: "Yes, Delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteBook(id).then((res) => {
            if (res.data.success) {
              this.$swal({
                title: "Success",
                text: "Successfully deleted the book",
                type: "success",
              });
              this.getBookList(this.queryStrings);
            } else {
              if (res.data.code == 404) {
                this.$swal({
                  title: "Opps..",
                  text: res.data.message,
                  type: "error",
                });
              }
            }
          });
        }
      });
    },
    clickAscOrDesc(state) {
      this.titleAcsSort = false;
      this.tilteDescSort = false;
      this.authorAscSort = false;
      this.authorDescSort = false;
      if (state == "titleAsc") {
        this.titleAcsSort = true;
        this.queryStrings.sort = "title";
        this.queryStrings.order = "asc";
      }
      if (state == "titleDesc") {
        this.tilteDescSort = true;
        this.queryStrings.sort = "title";
        this.queryStrings.order = "desc";
      }
      if (state == "authorAsc") {
        this.authorAscSort = true;
        this.queryStrings.sort = "author";
        this.queryStrings.order = "asc";
      }
      if (state == "authorDesc") {
        this.authorDescSort = true;
        this.queryStrings.sort = "author";
        this.queryStrings.order = "desc";
      }
      this.setQueryParams();
      if (this.search_mood) {
        this.searchForm.params = this.queryStrings;
        this.searchBook(this.searchForm).then((res) => {
          if (res.data.success) {
            this.search_mood = true;
          }
        });
      } else {
        this.getBookList(this.queryStrings);
      }
    },
    openModal(Id) {
      this.modalshow = true;
      this.modalId = Id;
      this.btnText = "Download";
      if (Id == "csvModal") {
        this.setExportTitle("CSV Download");
      } else {
        this.setExportTitle("XML Download");
      }
    },
    paginate(e) {
      this.queryStrings.page = e;
      this.setQueryParams();
      if (this.search_mood) {
        this.searchForm.params = this.queryStrings;
        this.searchBook(this.searchForm).then((res) => {
          if (res.data.success) {
            this.search_mood = true;
          }
        });
      } else {
        this.getBookList(this.queryStrings);
      }
    },
  },
};
</script>
<style scoped>
label {
  font-size: 0.95rem;
}
th,
td {
  padding: 10px;
  border: 1px solid #cccccc;
}
table {
  border-style: hidden;
  margin: 0px;
}
.ch-th-one {
  width: 341px;
}
.ch-th-two {
  width: 341px;
}
.ch-th-three {
  width: 78px;
  padding-bottom: 1.5rem;
}

.table-wrapper {
  overflow: auto;
  border-radius: 6px;
  border: 1px solid #dee2e6;
}
.editable-text {
  border-bottom: dashed 1px #428bca;
  cursor: pointer !important;
}
.editable-text:hover {
  cursor: text;
}
.form-control {
  padding: 0.15rem 0.75rem;
}
.form-outer-container {
  background: #f5f5f5;

  border-radius: 10px;
  border: thin solid #dee2e6;
}
.add-form-spacing {
  padding: 2vh 2vw;
}
.search-form-spacing {
  padding: 2vh 2vw;
}
.btn-container {
  height: 100%;
}
.btn {
  /* padding: 0rem 0.5rem; */
  font-size: 0.95rem;
}
.delete-button:hover {
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
  padding: 0 0 0 10px;
}
.sort-highlight,
.sort-icon:hover {
  cursor: pointer;
  background: #0d6efd;
  color: white;
  border-radius: 5px;
}
.fas {
  line-height: 0.5;
}
@media (min-width: 768px) {
  .author-input-container {
    padding-left: 20px;
  }
}
@media (max-width: 767.98px) {
  .input-row {
    padding-bottom: 3vh;
  }
  .add-form-spacing {
    padding: 3vh 2vw;
  }
  .search-form-spacing {
    padding: 3vh 3vw;
    margin-bottom: 21px;
  }
}
@media (max-width: 575.98px) {
  .input-row {
    flex-direction: column;
  }
  .table-author-column {
    flex-direction: column;
  }
  .edit-btns-container {
    padding: 10px 0 0 0;
  }
}
</style>
