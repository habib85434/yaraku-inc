<template>
  <button @click="callMethod()" :type="btnType" :class="fullClass">
    {{ btnText }}
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "DeleteButton",
  components: {},
  data() {
    return {
      fullClass: `btn delete-button ${this.className}`,
    };
  },
  props: ["btnText", "method", "btnType", "className"],
  methods: {
    callMethod() {
      if (this.method) {
        this.method();
      }
    },
  },
};
</script>
<style scoped>
.delete-button:hover {
  border-color: #6c757d;
}
.delete-button {
  background-image: linear-gradient(white, #b3b6b9);
  border-color: #b3b6b9;
  /* padding-top: 0.2rem;
  padding-bottom: 0.2rem; */
}
</style>
