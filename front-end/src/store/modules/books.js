import axios from "axios";

export default {
  namespaced: true,

  state: {
    bookList: {},
    export_title: "Download CSV",
  },

  getters: {
    bookList(state) {
      return state.bookList && state.bookList;
    },

    exportTitle(state) {
      return state.export_title && state.export_title;
    },
  },

  mutations: {
    SET_BOOK_LIST(state, data) {
      state.bookList = data;
    },

    SET_EXPORT_TITLE(state, data) {
      state.export_title = data;
    },
  },

  actions: {
    async getBookList({ dispatch }, data) {
      let url =
        "books?record=" +
        data.record +
        "&page=" +
        data.page +
        "&sort=" +
        data.sort +
        "&order=" +
        data.order;

      if (data.mode == "0000" || data.mode != "0101") {
        url = "books?record=" + data.record + "&page=" + data.page;
      }

      let response = await axios
        .get(url)
        .then((res) => {
          if (res.data.success) {
            dispatch("dispatchtBookList", res.data.data.books);
          }
        })
        .catch((error) => console.log(error));

      return response;
    },

    async dispatchtBookList({ commit }, data) {
      if (data) {
        commit("SET_BOOK_LIST", data);
      }
    },

    async setExportTitle({ dispatch }, data) {
      dispatch("dispatchExportTtile", data);
    },
    async dispatchExportTtile({ commit }, data) {
      if (data) {
        commit("SET_EXPORT_TITLE", data);
      }
    },

    async download(_, data) {
      console.log(data.title);
      if (data.type == "xml") {
        return await axios.post(
          "books/export-xml?title=" + data.title + "&author=" + data.author,
          null,
          {
            headers: { "Content-Type": "text/xml" },
            responseType: "blob",
          }
        );
      } else {
        return await axios.post(
          "books/export-csv?title=" + data.title + "&author=" + data.author,
          null,
          {
            headers: { "content-type": "application/json" },
          }
        );
      }
    },

    async deleteBook(_, id) {
      let response = await axios.delete("books/" + id);

      return response;
    },

    async updateBookAuthor(_, data) {
      let response = await axios.post(
        "books/" + data.id + "?_method=put",
        data
      );
      return response;
    },

    async searchBook({ dispatch }, data) {
      let response = await axios
        .post(
          "books/search?record=" +
          data.params.record +
          "&page=" +
          data.params.page +
          "&sort=" +
          data.params.sort +
          "&order=" +
          data.params.order,
          data.data
        )
        .then((res) => {
          if (res.data.success) {
            dispatch("dispatchtBookList", res.data.data.books);
            return res;
          }
        })
        .catch((error) => {
          console.log(error);
          response = error;
        });

      return response;
    },

    async storeBook(_, data) {
      let response = await axios.post("books", data);
      return response;
    },
  },
};
