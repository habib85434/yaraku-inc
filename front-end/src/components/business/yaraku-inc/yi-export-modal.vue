<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            {{ exportTitle }}
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <!-- <slot></slot> -->

        <form
          class="form-wrapper"
          @submit.prevent="handleSubmit(onSubmit)"
          enctype="multipart/form-data"
        >
          <div class="py-4 px-3">
            <label class="pb-3">
              Either one or both option must be selected before attempting to
              download the file
            </label>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                v-model="form.author"
                id="flexCheckDefault"
              />
              <label class="form-check-label" for="flexCheckDefault">
                Author
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckChecked"
                v-model="form.title"
              />
              <label class="form-check-label" for="flexCheckChecked">
                Title
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              data-bs-dismiss="modal"
              type="submit"
              class="btn btn-primary"
            >
              Download
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import { mapGetters } from "vuex";
import { Form } from "vform";

export default {
  name: "CSVModal",
  data() {
    return {
      form: new Form({
        title: true,
        author: false,
        type: "csv",
      }),
    };
  },
  //   components: {},
  computed: {
    ...mapGetters({
      exportTitle: "books/exportTitle",
    }),
  },
  methods: {
    ...mapActions({
      download: "books/download",
    }),
    handleSubmit() {
      let loader = this.$loading.show({ color: "#0B5ED7" });

      if (this.exportTitle == "CSV Download") {
        this.form.type = "csv";
      } else if (this.exportTitle == "XML Download") {
        this.form.type = "xml";
      }
      this.form.title = this.form.title ? 1 : 0;
      this.form.author = this.form.author ? 1 : 0;
      this.download(this.form)
        .then((res) => {
          if (this.form.type == "xml") {
            const url = window.URL.createObjectURL(new Blob([res.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", "books.xml");
            document.body.appendChild(link);
            link.click();
          } else if (this.form.type == "csv") {
            var fileURL = res.data.data.link;
            var fileLink = document.createElement("a");
            fileLink.href = fileURL;
            fileLink.click();
          }
          this.form.title = true;
          loader.hide();
        })
        .catch(() => {
          loader.hide();
        });
    },
  },
};
</script>
<style scoped>
.modal-footer {
  border-top: unset;
}
.modal-header {
  background: #b9b8b8;
}
</style>
