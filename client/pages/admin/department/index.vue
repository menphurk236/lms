<template>
  <div>
    <transition name="fade" mode="out-in">
      <router-view />
    </transition>
  </div>
</template>

<script>
export default {
  middleware: "auth",
};
</script>

<style>
</style>
