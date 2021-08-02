<template>
  <button @click="callMethod()" :type="btnType" :class="fullClass">
    {{ btnText }}
    <slot></slot>
  </button>
</template>

<script>
// @ is an alias to /src
//import HelloWorld from "@/components/HelloWorld.vue";
export default {
  name: "BasicButton",
  components: {},
  data() {
    return {
      fullClass: `btn btn-primary ${this.className}`,
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
<style scoped></style>
