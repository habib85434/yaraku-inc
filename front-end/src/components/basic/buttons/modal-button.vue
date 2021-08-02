<template>
  <button
    @click="callMethod()"
    :type="btnType"
    :class="fullClass"
    :title="title"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal"
  >
    {{ btnText }}
    <slot></slot>
  </button>
</template>

<script>
// @ is an alias to /src
//import HelloWorld from "@/components/HelloWorld.vue";
export default {
  name: "ModalButton",
  components: {},
  data() {
    return {
      fullClass: `btn btn-primary ${this.className}`,
    };
  },
  props: ["btnText", "method", "param", "btnType", "className", "title"],
  methods: {
    callMethod() {
      if (this.method) {
        if (this.param) {
          this.method(this.param);
        } else {
          this.method();
        }
      }
    },
  },
};
</script>
<style scoped></style>
