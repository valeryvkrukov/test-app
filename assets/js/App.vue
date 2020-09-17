<template>
  <div>
    <nav-bar @search-link="showLinkInfo" />
    <router-view />
  </div>
</template>

<script>
import NavBar from '@/components/NavBar';

export default {
  name: 'App',
  components: {
    NavBar
  },
  methods: {
    showLinkInfo(term) {
      const path = `/view/${term.searchKey}`;
      if (this.$route.name !== 'view') {
        this.$router.push(path);
      } else {
        this.$router.replace(path);
      }
    }
  }
}
</script>

<style scoped>

</style>